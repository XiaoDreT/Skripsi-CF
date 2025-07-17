<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Gejala;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDiagnosaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Diagnosa Penyakit',
            'content' => 'user/diagnosa/index',
        ];
        return view('user.layouts.wrapper', $data);
    }

    function createPasien(Request $request)
    {
        $data = [
            'nama_pasien' => $request->nama_pasien,
            'umur' => $request->umur,
        ];
        $pasien = Pasien::create($data);
        session()->put('pasien_id', $pasien->id);
        return redirect('/user/diagnosa/pilih-gejala');
    }

    public function pilihGejala()
    {
        $pasien_id = session()->get('pasien_id');
        $data = [
            'title' => 'Diagnosa Penyakit',
            'pasien' => Pasien::find($pasien_id),
            'gejala' => Gejala::get(),
            'gejalaTerpilih' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->groupBy('gejala_id')->get(),
            'content' => 'user/diagnosa/pilihgejala',
        ];
        return view('user.layouts.wrapper', $data);
    }

    function pilih()
    {
        $gejala_id = request('gejala_id');
        $cf_user = request('nilai');

        $role = Role::whereGejalaId($gejala_id)->get();
        foreach($role as $r){
            $data = [
                'pasien_id' => session()->get('pasien_id'),
                'gejala_id' => $gejala_id,
                'penyakit_id' => $r->penyakit_id,
                'nilai_cf' => $cf_user,
                'cf_hasil' => $cf_user * $r->bobot_cf,
            ];
            Diagnosa::create($data);
        }
        return redirect('/user/diagnosa/pilih-gejala');
    }

    function hapusGejalaTerpilih()
    {
        $gejala_id = request('gejala_id');
        $pasien_id = session()->get('pasien_id');
        $diagnosa = Diagnosa::wherePasienId($pasien_id)->whereGejalaId($gejala_id)->get();
        foreach($diagnosa as $item){
            $d = Diagnosa::find($item->id);
            $d->delete();
        }
        return redirect('/user/diagnosa/pilih-gejala');
    }

    function prosesDiagnosa(){
        $pasien_id = session()->get('pasien_id');
        $hasil = 0;
        $penyakit_id = '';

        // Validasi jumlah gejala terpilih
        $diagnosaCount = Diagnosa::wherePasienId($pasien_id)->count();
        if ($diagnosaCount <= 1) {
            return redirect('/user/diagnosa/pilih-gejala')->with('warning', 'Silakan pilih lebih dari satu gejala terlebih dahulu.');
        }

        // Ambil semua penyakit yang ada
        $penyakit = Penyakit::get();
        
        // Array untuk menyimpan hasil CF setiap penyakit
        $hasilPenyakit = [];
        
        foreach($penyakit as $p){
            // Ambil semua gejala yang dipilih user untuk penyakit ini
            $diagnosa = Diagnosa::wherePenyakitId($p->id)->wherePasienId($pasien_id)->get();
            
            // Hitung CF untuk penyakit ini
            $diagnosa_hasil = $this->hitung_cf($diagnosa);
            
            // Hitung jumlah gejala yang cocok dengan CF > 0
            $jumlahGejalaCocok = Diagnosa::wherePenyakitId($p->id)
                ->wherePasienId($pasien_id)
                ->where('cf_hasil', '>', 0)
                ->count();
            
            // Hitung rata-rata CF gejala yang cocok
            $rataRataCF = 0;
            if($jumlahGejalaCocok > 0) {
                $totalCF = Diagnosa::wherePenyakitId($p->id)
                    ->wherePasienId($pasien_id)
                    ->where('cf_hasil', '>', 0)
                    ->sum('cf_hasil');
                $rataRataCF = $totalCF / $jumlahGejalaCocok;
            }
            
            $hasilPenyakit[] = [
                'penyakit_id' => $p->id,
                'cf_hasil' => $diagnosa_hasil,
                'jumlah_gejala' => $jumlahGejalaCocok,
                'rata_rata_cf' => $rataRataCF
            ];
        }

        // Urutkan berdasarkan kriteria prioritas
        usort($hasilPenyakit, function($a, $b) {
            // Kriteria 1: CF hasil tertinggi
            if(abs($a['cf_hasil'] - $b['cf_hasil']) > 0.001) {
                return $b['cf_hasil'] <=> $a['cf_hasil'];
            }
            
            // Kriteria 2: Jika CF sama, pilih yang memiliki gejala lebih banyak
            if($a['jumlah_gejala'] != $b['jumlah_gejala']) {
                return $b['jumlah_gejala'] <=> $a['jumlah_gejala'];
            }
            
            // Kriteria 3: Jika jumlah gejala sama, pilih yang rata-rata CF lebih tinggi
            return $b['rata_rata_cf'] <=> $a['rata_rata_cf'];
        });

        // Ambil penyakit dengan skor tertinggi
        if(count($hasilPenyakit) > 0) {
            $hasil = $hasilPenyakit[0]['cf_hasil'];
            $penyakit_id = $hasilPenyakit[0]['penyakit_id'];
        }

        // Jika tidak ada penyakit yang cocok (hasil = 0), cari penyakit dengan gejala paling banyak
        if($hasil == 0){
            $penyakitTerbaik = null;
            $gejalaTerbanyak = 0;
            
            foreach($penyakit as $p){
                $jumlahGejala = Diagnosa::wherePenyakitId($p->id)
                    ->wherePasienId($pasien_id)
                    ->where('cf_hasil', '>', 0)
                    ->count();
                
                if($jumlahGejala > $gejalaTerbanyak){
                    $gejalaTerbanyak = $jumlahGejala;
                    $penyakitTerbaik = $p;
                }
            }
            
            if($penyakitTerbaik){
                $penyakit_id = $penyakitTerbaik->id;
                $hasil = 0.1; // Nilai minimal untuk menunjukkan ada kecocokan
            }
        }

        $pasien = Pasien::find($pasien_id);
        $pasien->akumulasi_cf = $hasil;
        $pasien->persentase = round($hasil * 100);
        $pasien->penyakit_id = $penyakit_id;
        $pasien->save();
        
        return redirect('/user/diagnosa/keputusan/' . $pasien_id);
    }

    function hitung_cf($data)
    {
        if($data->count() == 0){
            return 0;
        }
        
        if($data->count() == 1){
            return $data->first()->cf_hasil;
        }
        
        $cf_old = $data->first()->cf_hasil;
        
        for($i = 1; $i < $data->count(); $i++){
            $cf_new = $data[$i]->cf_hasil;
            $cf_old = $cf_old + $cf_new * (1 - $cf_old);
        }
        
        return $cf_old;
    }

    public function keputusan($pasien_id)
    {
        if($pasien_id == null){
            $pasien_id = session()->get('pasien_id');
        }
        
        // Ambil data pasien dan gejala
        $pasien = Pasien::with('penyakit')->find($pasien_id);
        $gejala = Diagnosa::with('gejala')->wherePasienId($pasien_id)->get();
        
        // Hitung rekomendasi penyakit alternatif
        $rekomendasiPenyakit = $this->hitungRekomendasiPenyakit($pasien_id);
        
        $data = [
            'title' => 'Diagnosa Penyakit',
            'pasien' => $pasien,
            'gejala' => $gejala,
            'rekomendasiPenyakit' => $rekomendasiPenyakit,
            'content' => 'user/diagnosa/keputusan',
        ];
        return view('user.layouts.wrapper', $data);
    }

    private function hitungRekomendasiPenyakit($pasien_id)
    {
        $penyakit = Penyakit::get();
        $rekomendasi = [];
        
        foreach($penyakit as $p){
            $diagnosa = Diagnosa::wherePenyakitId($p->id)->wherePasienId($pasien_id)->get();
            $cf_hasil = $this->hitung_cf($diagnosa);
            
            if($cf_hasil > 0){
                // Ambil gejala yang cocok dengan penyakit ini
                $gejalaCocok = Diagnosa::with('gejala')
                    ->wherePenyakitId($p->id)
                    ->wherePasienId($pasien_id)
                    ->where('cf_hasil', '>', 0)
                    ->get();
                
                // Hitung jumlah gejala yang cocok
                $jumlahGejalaCocok = $gejalaCocok->count();
                
                // Hitung rata-rata CF gejala yang cocok
                $rataRataCF = 0;
                if($jumlahGejalaCocok > 0) {
                    $totalCF = $gejalaCocok->sum('cf_hasil');
                    $rataRataCF = $totalCF / $jumlahGejalaCocok;
                }
                
                $rekomendasi[] = [
                    'penyakit' => $p,
                    'cf_hasil' => $cf_hasil,
                    'persentase' => round($cf_hasil * 100),
                    'gejala_cocok' => $gejalaCocok,
                    'jumlah_gejala' => $jumlahGejalaCocok,
                    'rata_rata_cf' => $rataRataCF
                ];
            }
        }
        
        // Urutkan berdasarkan kriteria yang sama dengan proses diagnosa
        usort($rekomendasi, function($a, $b) {
            // Kriteria 1: CF hasil tertinggi
            if(abs($a['cf_hasil'] - $b['cf_hasil']) > 0.001) {
                return $b['cf_hasil'] <=> $a['cf_hasil'];
            }
            
            // Kriteria 2: Jika CF sama, pilih yang memiliki gejala lebih banyak
            if($a['jumlah_gejala'] != $b['jumlah_gejala']) {
                return $b['jumlah_gejala'] <=> $a['jumlah_gejala'];
            }
            
            // Kriteria 3: Jika jumlah gejala sama, pilih yang rata-rata CF lebih tinggi
            return $b['rata_rata_cf'] <=> $a['rata_rata_cf'];
        });
        
        return $rekomendasi;
    }

    public function riwayat_diagnosa()
    {
        $name_user = Auth::user()->name;

        $diagnosas = Pasien::where('nama_pasien', $name_user)->with('penyakit')->get();

        return view('user.diagnosa.riwayat', compact('diagnosas'));
    }
}

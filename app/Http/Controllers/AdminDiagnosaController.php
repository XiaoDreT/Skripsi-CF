<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Penyakit;
use App\Models\Pasien;
use App\Models\Gejala;
use App\Models\Role;
use Illuminate\Http\Request;

class AdminDiagnosaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Diagnosa Penyakit',
            'content' => 'admin/diagnosa/index',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    function createPasien(Request $request)
    {
        $data = [
            'nama_pasien' => $request->nama_pasien,
            'umur' => $request->umur,
        ];
        $pasien = Pasien::create($data);
        session()->put('pasien_id', $pasien->id);
        return redirect('/admin/diagnosa/pilih-gejala');
    }

    public function pilihGejala()
    {
        $pasien_id = session()->get('pasien_id');
        $data = [
            'title' => 'Diagnosa Penyakit',
            'pasien' => Pasien::find($pasien_id),
            'gejala' => Gejala::get(),
            'gejalaTerpilih' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->groupBy('gejala_id')->get(),
            'content' => 'admin/diagnosa/pilihgejala',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    function pilih()
    {
        $gejala_id = request('gejala_id');
        $cf_user = request('nilai');

        $role = Role::whereGejalaId($gejala_id)->get();
        foreach ($role as $r) {
            $data = [
                'pasien_id' => session()->get('pasien_id'),
                'gejala_id' => $gejala_id,
                'penyakit_id' => $r->penyakit_id,
                'nilai_cf' => $cf_user,
                'cf_hasil' => $cf_user * $r->bobot_cf,
            ];
            Diagnosa::create($data);
        }
        return redirect('/admin/diagnosa/pilih-gejala');
    }

    function hapusGejalaTerpilih()
    {
        $gejala_id = request('gejala_id');
        $pasien_id = session()->get('pasien_id');
        $diagnosa = Diagnosa::wherePasienId($pasien_id)->whereGejalaId($gejala_id)->get();
        foreach ($diagnosa as $item) {
            $d = Diagnosa::find($item->id);
            $d->delete();
        }
        return redirect('/admin/diagnosa/pilih-gejala');
    }

    function prosesDiagnosa()
    {
        $pasien_id = session()->get('pasien_id');
        $hasil = 0;
        $penyakit_id = '';

        $role = Role::get();

        // Validasi jumlah gejala terpilih
        $diagnosaCount = Diagnosa::wherePasienId($pasien_id)->count();
        if ($diagnosaCount <= 1) {
            return redirect('/admin/diagnosa/pilih-gejala')->with('warning', 'Silakan pilih lebih dari satu gejala terlebih dahulu.');
        }

        foreach ($role as $r) {
            $diagnosa = Diagnosa::wherePasienId($pasien_id)->wherePenyakitId($r->penyakit_id)->whereGejalaId($r->gejala_id)->first();

            if ($diagnosa == null) {
                $data = [
                    'pasien_id' => $pasien_id,
                    'penyakit_id' => $r->penyakit_id,
                    'gejala_id' => $r->gejala_id,
                    'nilai_cf' => 0,
                    'cf_hasil' => 0
                ];

                Diagnosa::create($data);
            }
        }

        $penyakit = Penyakit::get();
        foreach ($penyakit as $p) {
            $diagnosa = Diagnosa::wherePenyakitId($p->id)->wherePasienId($pasien_id)->get();
            $diagnosa_hasil = $this->hitung_cf($diagnosa);
            if ($diagnosa_hasil > $hasil) {
                $hasil = $diagnosa_hasil;
                $penyakit_id = $p->id;
            }
        }

        $pasien = Pasien::find($pasien_id);
        $pasien->akumulasi_cf = $hasil;
        $pasien->persentase = round($hasil * 100);
        $pasien->penyakit_id = $penyakit_id;
        $pasien->save();
        return redirect('/admin/diagnosa/keputusan/' . $pasien_id);
    }

    function hitung_cf($data)
    {
        $cf_old = 0;
        foreach ($data as $key => $value) {
            if ($key == 0) {
                $cf_old = 0;
            } else {
                $cf_old = $cf_old + $value->cf_hasil * (1 - $cf_old);
            }
        }
        return $cf_old;
    }

    public function keputusan($pasien_id)
    {
        if ($pasien_id == null) {
            $pasien_id = session()->get('pasien_id');
        }
        $data = [
            'title' => 'Diagnosa Penyakit',
            'pasien' => Pasien::with('penyakit')->find($pasien_id),
            'gejala' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->get(),
            'content' => 'admin/diagnosa/keputusan',
        ];
        return view('admin.layouts.wrapper', $data);
    }

}

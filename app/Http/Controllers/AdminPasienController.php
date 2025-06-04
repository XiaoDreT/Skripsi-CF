<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use App\Models\Pasien;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPasienController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Pasien',
            'pasien' => Pasien::with('penyakit')->orderBy('created_at', 'DESC')->paginate(10),
            'content' => 'admin/pasien/index',
        ];
        return view('admin.layouts.wrapper', $data);
    }
    
    public function destroy(string $id)
    {
        $pasien = Pasien::find($id);
        $pasien->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/admin/pasien');
    }

    public function print($pasien_id)
    {
        $data = [
            'title' => 'Diagnosa Penyakit',
            'pasien' => Pasien::with('penyakit')->find($pasien_id),
            'gejala' => Diagnosa::with('gejala')->wherePasienId($pasien_id)->get(),
        ];
        return view('admin.pasien.cetak', $data);
    }

}

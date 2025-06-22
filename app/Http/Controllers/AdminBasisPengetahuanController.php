<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminBasisPengetahuanController extends Controller
{
    public function index()
    {
        $basisPengetahuan = [
            ['nama_penyakit' => 'Eksim', 'kode_gejala' => 'G1'],
            ['nama_penyakit' => 'Eksim', 'kode_gejala' => 'G2'],
            ['nama_penyakit' => 'Eksim', 'kode_gejala' => 'G3'],
            ['nama_penyakit' => 'Eksim', 'kode_gejala' => 'G4'],
            ['nama_penyakit' => 'Campak', 'kode_gejala' => 'G5'],
            ['nama_penyakit' => 'Campak', 'kode_gejala' => 'G6'],
            ['nama_penyakit' => 'Campak', 'kode_gejala' => 'G7'],
            ['nama_penyakit' => 'Campak', 'kode_gejala' => 'G8'],
            ['nama_penyakit' => 'Campak', 'kode_gejala' => 'G9'],
            ['nama_penyakit' => 'Campak', 'kode_gejala' => 'G10'],
            ['nama_penyakit' => 'Kudis', 'kode_gejala' => 'G11'],
            ['nama_penyakit' => 'Kudis', 'kode_gejala' => 'G12'],
            ['nama_penyakit' => 'Kudis', 'kode_gejala' => 'G13'],
            ['nama_penyakit' => 'Kudis', 'kode_gejala' => 'G14'],
            ['nama_penyakit' => 'Herpes', 'kode_gejala' => 'G15'],
            ['nama_penyakit' => 'Herpes', 'kode_gejala' => 'G16'],
            ['nama_penyakit' => 'Herpes', 'kode_gejala' => 'G17'],
            ['nama_penyakit' => 'Herpes', 'kode_gejala' => 'G18'],
            ['nama_penyakit' => 'Herpes', 'kode_gejala' => 'G19'],
            ['nama_penyakit' => 'Psoriasis', 'kode_gejala' => 'G20'],
            ['nama_penyakit' => 'Psoriasis', 'kode_gejala' => 'G21'],
            ['nama_penyakit' => 'Psoriasis', 'kode_gejala' => 'G22'],
            ['nama_penyakit' => 'Psoriasis', 'kode_gejala' => 'G23'],
        ];

        $data = [
            'title' => 'Basis Pengetahuan',
            'basisPengetahuan' => $basisPengetahuan,
            'content' => 'admin/basis_pengetahuan/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }
}
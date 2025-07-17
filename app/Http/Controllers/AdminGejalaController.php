<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminGejalaController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Gejala',
            'gejala' => Gejala::get(),
            'content' => 'admin/gejala/index',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Gejala',
            'content' => 'admin/gejala/create',

        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_gejala' => 'required|unique:gejalas',
            'nama_gejala' => 'required',
            'nilai_cf' => 'required',
        ]);

        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
        Gejala::create($data);
        return redirect('/admin/gejala');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit gejala',
            'gejala' => Gejala::find($id),
            'content' => 'admin/gejala/create',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gejala = Gejala::find($id);
        $data = $request->validate([
            'kode_gejala' => 'required|unique:gejalas',
            'nama_gejala' => 'required',
            'nilai_cf' => 'required',
        ]);

        $gejala->update($data);
        Alert::success('Sukses', 'Data Berhasil Diubah');
        return redirect('/admin/gejala');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gejala = Gejala::find($id);
        $gejala->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/admin/gejala');
    }
}

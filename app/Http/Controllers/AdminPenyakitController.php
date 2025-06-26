<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Role;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPenyakitController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Manajemen Penyakit',
            'penyakit' => Penyakit::get(),
            'content' => 'admin/penyakit/index',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Penyakit',
            'content' => 'admin/penyakit/create',

        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_penyakit' => 'required',
            'deskripsi' => 'required',
            'solusi' => 'required',
        ]);

        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
        Penyakit::create($data);
        return redirect('/admin/penyakit');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = Role::with('gejala')->where('penyakit_id', $id)->get();
        $data = [
            'title' => 'Detail Penyakit',
            'penyakit' => Penyakit::find($id),
            'gejala' => Gejala::get(),
            'role' => $role,
            'content' => 'admin/penyakit/show',

        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit penyakit',
            'penyakit' => Penyakit::find($id),
            'content' => 'admin/penyakit/create',
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penyakit = Penyakit::find($id);
        $data = $request->validate([
            'nama_penyakit' => 'required',
            'deskripsi' => 'required',
            'solusi' => 'required',
        ]);

        $penyakit->update($data);
        Alert::success('Sukses', 'Data Berhasil Diubah');
        return redirect('/admin/penyakit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penyakit = Penyakit::find($id);
        $penyakit->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/admin/penyakit');
    }

    function addGejala(Request $request)
    {
        // dd($request->all());
        $data = [
            'penyakit_id' => $request->penyakit_id,
            'gejala_id' => $request->gejala_id,
            'bobot_cf' => $request->bobot_cf,
        ];

        Role::create($data);
        Alert::success('Sukses', 'Data Berhasil Ditambahkan');
        return redirect('/admin/penyakit/' . $request->penyakit_id);
    }

    function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();
        Alert::success('Sukses', 'Data Berhasil Dihapus');
        return redirect('/admin/penyakit/'.$role->penyakit_id);
    }
}

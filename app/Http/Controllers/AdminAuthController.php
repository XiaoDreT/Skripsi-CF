<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    function index(){
        return view('admin.auth.login');
    }

    function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($data)){
            $request->session()->regenerate();
            return redirect('/admin/diagnosa');
        }

        return back()->with('loginError', 'Gagal Login. Data tidak ditemukan');
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success('Berhasil', 'Anda telah keluar dari sistem');
        return redirect('/login');
    }
}

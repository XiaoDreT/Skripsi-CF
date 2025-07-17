<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminAuthController extends Controller
{
    function index(){
        return view('admin.auth.login');
    }

    public function register(){
        return view ('admin.auth.register');
    }

    public function storeRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        Auth::login($user);
        return redirect('/user/diagnosa');
    }

    function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($data)){
            $request->session()->regenerate();
            $user = Auth::user();

            if($user->role == 'admin'){
                Alert::success('Berhasil', 'Anda berhasil masuk ke sistem');
                return redirect('/admin/diagnosa');
            } elseif($user->role == 'user') {
                return redirect(('/user/diagnosa'));
            } else {
                Auth::logout();
                return back()->with('loginError', 'Gagal Login. Data tidak ditemukan');
            }
        }

        return back()->with('loginError', 'Gagal Login. Data tidak ditemukan');
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success('Berhasil', 'Anda telah keluar dari sistem');
        return redirect('/');
    }
}

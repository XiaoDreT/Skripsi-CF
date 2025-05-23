<?php

namespace App\Http\Controllers;

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
}

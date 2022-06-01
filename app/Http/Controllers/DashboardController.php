<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');

        return view('dashboard');
    }

    public function logout(Request $r)
    {
        $r->session()->forget('user');
        return redirect('/');
    }
}

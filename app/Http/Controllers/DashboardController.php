<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'dashboard';
        return view('dashboard',compact('menu'));
    }

    public function logout(Request $r)
    {
        $r->session()->forget('user');
        return redirect('/');
    }

    public function logoutGuest(Request $r)
    {
        $r->session()->forget('guest');
        return redirect('/guest');
    }
}

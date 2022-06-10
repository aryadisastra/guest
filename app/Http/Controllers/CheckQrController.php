<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckQrController extends Controller
{
    public function index()
    {
        return view('check-qr');
    }
    public function scan($id)
    {
        return $id;
    }
}

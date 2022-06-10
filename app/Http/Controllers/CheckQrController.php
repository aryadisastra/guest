<?php

namespace App\Http\Controllers;

use App\Invitation;
use Illuminate\Http\Request;

class CheckQrController extends Controller
{
    public function index()
    {
        return view('check-qr');
    }
    public function scan($id)
    {
        $check = Invitation::where('value','ilike',$id)->first();
        if($check) return true;
        return false;
        
    }
}

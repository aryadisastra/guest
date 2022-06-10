<?php

namespace App\Http\Controllers;

use App\Histori;
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
        if($check){
            $history = Histori::where('id_invitation',$check->id_invitation)->where('id_tamu',$check->tamu)->first();
            $history->keterangan = 'Di Hadiri';
            return true;
        } 
        return false;
        
    }
}

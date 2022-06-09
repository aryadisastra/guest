<?php

namespace App\Http\Controllers;

use App\Bagian;
use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $r)
    {
        $password = sha1(md5(sha1($r->password)));
        $cekUser = User::where('username',$r->username)->where('password',$password)->first();
        if($cekUser)
        {
            if($cekUser->status != 1) return redirect('/')->with('error','Maaf Akun Anda Sedang Ditangguhkan');

            $getBagian = Bagian::where('id',$cekUser->bagian)->first();

            session(['user' => [
                'nama'          => $cekUser->nama,
                'id'            => $cekUser->id,
                'username'      => $cekUser->username,
                'bagian'        => isset($getBagian->nama_bagian) ? $getBagian->nama_bagian : ''
                ]
            ]);

            return redirect('/dashboard');
        } else {
            return redirect('/')->with('error','Maaf Akun Anda Tidak Terdaftar');
        }
    }
}

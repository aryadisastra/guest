<?php

namespace App\Http\Controllers;

use App\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    public function index()
    {
        if(session('guest')) return redirect('/guest/dashboard');
        return view('welcome-guest');
    }

    public function login(Request $r)
    {
        $cekUser = Tamu::where('nomor_ktp',$r->no_ktp)->where('status',1)->first();
        if($cekUser)
        {
            if($cekUser->status != 1) return redirect('/guest')->with('error','Maaf Akun Sudah Non-Aktif Silahkan Hubungi Staff Kami');

            session(['guest' => [
                'nama'               => $cekUser->nama,
                'nomor_ktp'          => $cekUser->nomor_ktp,
                'email'              => $cekUser->email,
                'no_hp'              => $cekUser->email,
                'alamat'             => $cekUser->alamat,
                'id'                 => $cekUser->id,
                'otp'                => null,
                ]
            ]);

            return redirect('/get-verification');
        } else {
            return redirect('/guest')->with('error','Maaf Akun Anda Tidak Terdaftar');
        }
    }

    public function dashboard()
    {
        if(!session('guest')) return redirect('/guest');
        $menu = 'dashboard';
        return view('dashboard',compact('menu'));
    }

    public function verification()
    {
        if(!session('guest')) return redirect('/guest');
        $str        = "";
        $characters = '1234567890';
        $max        = strlen($characters) - 1;
        for ($i = 0; $i < 5; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        $data = [
            'nama' => session('guest')['nama'],
            'otp' => $str,
        ];
        $email = session('guest')['email'];
        Mail::send('email-verification',$data, function($mail) use($email)
            {
                $mail->to($email,'no-reply')
                     ->subject("OTP");
                $mail->from('vimee@vimee.com','Guest App');
            });

        if(Mail::failures())
        {
            return redirect('/guest')->with('error','Gagal Mengirim Email !!');
        }
        session(['guest' => [
            'nama'               => session('guest')['nama'],
            'nomor_ktp'          => session('guest')['nomor_ktp'],
            'email'              => session('guest')['email'],
            'no_hp'              => session('guest')['no_hp'],
            'alamat'             => session('guest')['alamat'],
            'id'                 => session('guest')['id'],
            'otp'                => md5(sha1(md5($str))),
            ]
        ]);
        return redirect('/guest-verification');
        
    }

    public function verificationview()
    {
        if(!session('guest')) return redirect('/guest');
        return view('guest-verification');
    }

    public function postOTP(Request $r)
    {
        if(!session('guest')) return redirect('/guest');
        $otp = md5(sha1(md5($r->otp)));
        if($otp != session('guest')['otp'])
        {
            return redirect('/guest-verification')->with('error','Kode OTP Salah!');
        }
        return redirect('/guest/dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use App\Tamu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TamuController extends Controller
{
    public function index()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'tamu';
        $bagian = Tamu::where('status',1)->orderBy('id','asc')->get();
        if(strtolower(session('user')['bagian']) == 'admin') $bagian = Tamu::orderBy('id','asc')->get();
        return view('tamu',compact('menu','bagian'));
    }

    public function create()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'tamu';
        return view('tamu-create',compact('menu'));
    }
    
    public function add(Request $r)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        DB::begintransaction();
        try{
            $email = $r->email;
            $add = new Tamu();
            $add->nama = $r->nama;
            $add->nomor_ktp = $r->no_ktp;
            $add->email = $r->email;
            $add->no_hp = $r->no_hp;
            $add->alamat = $r->alamat;
            $add->status = 1;
            $add->save();
            $data = array(
                'nama'          => $r->nama,
                'nomor_ktp'     => $r->no_ktp,
            );

            Mail::send('email-template',$data, function($mail) use($email)
            {
                $mail->to($email,'no-reply')
                     ->subject("Anda Telah Menjadi Bagian Dari Guest APP");
                $mail->from('aryadisastra63@gmail.com','Pendaftaran');
            });

            if(Mail::failures())
            {
                DB::rollback();
                return redirect('/tamu/create')->with('error','Gagal Mengirim Email !!');
            }
            
            DB::commit();
            return redirect('/tamu')->with('success','Tamu Dengan Nama "'.$r->nama.'" Berhasil dibuat!');
            
        } catch(Exception $e)
        {
            DB::rollback();
            return redirect('/tamu/create')->with('error',$e->getMessage());
        }
    }

    public function view($id)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'tamu';
        $data = Tamu::where('id',$id)->first();
        return view('tamu-detail',compact('menu','data'));
    }

    public function edit($id)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'bagian';
        $data = Bagian::where('id',$id)->first();
        return view('bagian-edit',compact('menu','data'));
    }

    public function update(Request $r)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        DB::begintransaction();
        try {

            $data = Bagian::where('id',$r->id)->first();
            $data->nama_bagian = $r->nama;
            $data->status = $r->status;
            $data->save();

            DB::commit();
            return redirect('/bagian')->with('success','Berhasil Edit !');
        } catch(Exception $e){
            DB::rollback();
            return redirect('/bagian/edit/'.$r->id)->with('error',$e->getMessage());
        }
    }
}

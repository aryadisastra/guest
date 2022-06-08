<?php

namespace App\Http\Controllers;

use App\Bagian;
use App\Pengguna;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaController extends Controller
{
    public function index()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'pengguna';
        $bagian = Pengguna::where('status',1)->orderBy('id','asc')->get();
        if(strtolower(session('user')['bagian']) == 'admin') $bagian = Pengguna::orderBy('id','asc')->get();
        return view('pengguna',compact('menu','bagian'));
    }

    public function create()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'pengguna';
        $bagian = Bagian::where('status',1)->orderBy('id','ASC')->get();
        return view('pengguna-create',compact('menu','bagian'));
    }
    
    public function add(Request $r)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        DB::begintransaction();
        try{
            $add = new Pengguna();
            $add->nama = $r->nama;
            $add->username = $r->username;
            $add->password = sha1(md5(sha1($r->password)));
            $add->status = 1;
            $add->bagian = $r->bagian;
            $add->save();
            
            DB::commit();
            return redirect('/pengguna')->with('success','Bagian "'.$r->nama.'" Berhasil dibuat!');
            
        } catch(Exception $e)
        {
            DB::rollback();
            return redirect('/pengguna/create')->with('error',$e->getMessage());
        }
    }

    public function view($id)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'pengguna';
        $data = Pengguna::where('id',$id)->first();
        return view('pengguna-detail',compact('menu','data'));
    }

    public function edit($id)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'pengguna';
        $data = Pengguna::where('id',$id)->first();
        $bagian = Bagian::where('status',1)->get();
        return view('pengguna-edit',compact('menu','data','bagian'));
    }

    public function update(Request $r)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        DB::begintransaction();
        try {

            $data = Pengguna::where('id',$r->id)->first();
            $data->nama = $r->nama;
            $data->username = $r->username;
            $data->password = isset($r->password) ? $r->password : $data->password;
            $data->bagian = $r->bagian;
            $data->status = $r->status;
            $data->save();

            DB::commit();
            return redirect('/pengguna')->with('success','Berhasil Edit !');
        } catch(Exception $e){
            DB::rollback();
            return redirect('/pengguna/edit/'.$r->id)->with('error',$e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Bagian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BagianController extends Controller
{
    
    public function index()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'bagian';
        $bagian = Bagian::where('status',1)->orderBy('id','asc')->get();
        if(strtolower(session('user')['bagian']) == 'admin') $bagian = Bagian::orderBy('id','asc')->get();
        return view('bagian',compact('menu','bagian'));
    }

    public function create()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'bagian';
        return view('bagian-create',compact('menu'));
    }
    
    public function add(Request $r)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        DB::begintransaction();
        try{
            $add = new Bagian();
            $add->nama_bagian = $r->nama;
            $add->save();
            
            DB::commit();
            return redirect('/bagian')->with('success','Bagian "'.$r->nama.'" Berhasil dibuat!');
            
        } catch(Exception $e)
        {
            DB::rollback();
            return redirect('/bagian/create')->with('error',$e->getMessage());
        }
    }

    public function view($id)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'bagian';
        $data = Bagian::where('id',$id)->first();
        return view('bagian-detail',compact('menu','data'));
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

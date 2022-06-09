<?php

namespace App\Http\Controllers;

use App\Agenda;
use App\Histori;
use App\Invitation;
use App\Pengguna;
use App\Tamu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AgendaController extends Controller
{
    public function index()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'agenda';
        $agenda = Agenda::orderBy('id','asc')->get();
        return view('agenda',compact('menu','agenda'));
    }

    public function create()
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'pengguna';
        $pengguna = Pengguna::where('status',1)->where('bagian',5)->orderBy('id','ASC')->get();
        return view('agenda-create',compact('menu','pengguna'));
    }
    
    public function add(Request $r)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        DB::begintransaction();
        try{
            $add = new Agenda();
            $add->acara                     = $r->acara;
            $add->tanggal_dimulai           = $r->tanggal_dimulai;
            $add->tanggal_selesai           = $r->tanggal_selesai;
            $add->koordinator               = $r->koordinator;
            $add->tempat                    = $r->tempat;
            $add->anggaran                  = $r->anggaran;
            $add->catatan                   = $r->catatan;
            $add->created_by                = session('user')['id'];
            $add->status_persetujuan        = 1;
            $add->save();
            
            DB::commit();
            return redirect('/agenda')->with('success','Agenda "'.$r->acara.'" Berhasil dibuat!');
            
        } catch(Exception $e)
        {
            DB::rollback();
            return redirect('/agenda/create')->with('error',$e->getMessage());
        }
    }

    public function view($id)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'agenda';
        $data = Agenda::where('id',$id)->first();
        return view('agenda-detail',compact('menu','data'));
    }

    public function edit($id)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        $menu = 'agenda';
        $data = Agenda::where('id',$id)->first();
        $pengguna = pengguna::where('bagian',5)->get();
        return view('agenda-edit',compact('menu','data','pengguna'));
    }

    public function update(Request $r)
    {
        if(!session('user')) return redirect('/')->with('error','Waktu Login Anda Habis');
        DB::begintransaction();
        try {

            $data = Pengguna::where('id',$r->id)->first();
            $data->acara                     = $r->acara;
            $data->tanggal_dimulai           = $r->tanggal_dimulai;
            $data->tanggal_selesai           = $r->tanggal_selesai;
            $data->koordinator               = $r->koordinator;
            $data->tempat                    = $r->tempat;
            $data->anggaran                  = $r->anggaran;
            $data->catatan                   = $r->catatan;
            $data->save();

            DB::commit();
            return redirect('/agenda')->with('success','Berhasil Edit !');
        } catch(Exception $e){
            DB::rollback();
            return redirect('/agenda/edit/'.$r->id)->with('error',$e->getMessage());
        }
    }

    public function updateStatus($id)
    {
        $data = Agenda::where('id',$id)->first();
        DB::begintransaction();
        try{
            if(session('user')['id'] == 2){
                $data->status_persetujuan = intval($data->status_persetujuan) + 2;
            } else {
                $data->status_persetujuan = intval($data->status_persetujuan) + 1;
            }
            $data->save();
            DB::commit();
            
            return redirect('/agenda')->with('success','Berhasil Menyetujui Acara '.$data->acara);
        } catch(Exception $e)
        {
            DB::rollBack();
            return redirect('/agenda')->with('success',$e->getMessage());
        }
    }

    public function invite($id)
    {
        $getTamu = Tamu::where('status',1)->get();
        DB::begintransaction();
        $random = Invitation::generateNameFiles();
        try{
            foreach($getTamu as $dt)
            {
                $undangan = new Invitation();
                $undangan->id_invitation = $random;
                $undangan->id_agenda = $id;
                $undangan->tamu = $dt->id;
                $undangan->qr_code = 'Test';
                $undangan->value = url('/').'/scan-qr/'.md5(sha1(md5($random)));
                $undangan->status = 1;
                $undangan->save();

                $histori = new Histori();
                $histori->id_invitation = $undangan->id_invitation;
                $histori->keterangan = 'Di Undang';
                $histori->save();
                
                $acara = Agenda::where('id',$id)->first();
                $qrcode = QrCode::size(100)->generate(url('/').'/scan-qr/'.md5(sha1(md5($random)))) ;
                $data = array(
                    'nama'          => $dt->nama,
                    'acara'         => $acara->acara,
                    'tanggal'       => $acara->tanggal_dimulai,
                    'id'            => md5(sha1(md5($random))),
                    'codeqr'        => $qrcode,
                );

                $email = $dt->email;
                Mail::send('email-undangan',$data, function($mail) use($email)
                {
                    $mail->to($email,'no-reply')
                        ->subject("Undangan Acara");
                    $mail->from('aryadisastra63@gmail.com','Guest App');
                });

                if(Mail::failures())
                {
                    DB::rollback();
                    return redirect('/tamu/create')->with('error','Gagal Mengirim Email !!');
                }
                
                DB::commit();
                
                return redirect('/agenda')->with('success','Berhasil Mengundang Acara Pada Seluruh Tamu Yang Aktif');
            }
        } catch(Exception $e)
        {
            DB::rollBack();
            dd($e);
            return redirect('/agenda')->with('success',$e->getMessage());
        }
    }
}

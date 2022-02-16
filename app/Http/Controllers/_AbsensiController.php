<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\DataMagang;
use Illuminate\Http\Request;

class _AbsensiController extends Controller
{
    public function index(){

        $data = Absensi::where('id_user',session('magang.id'))
        ->where('tanggal',date('Y-m-d'))
        ->first();

        date_default_timezone_set('Asia/Jakarta');
        $jam = date('H:i:s',strtotime('09:00:00'));
        $now = date('H:i:s');

        if ($now > $jam){
            // return $data;
            if (empty($data)){
                $dataMagang=DataMagang::where('id_user',session('magang.id'))->first();
                $hadir=new Absensi();
                $hadir->id_user = $dataMagang->id_user;
                $hadir->nama = $dataMagang->nama;
                $hadir->alamat = $dataMagang->alamat;
                $hadir->tanggal = date('Y-m-d');
                date_default_timezone_set('Asia/Jakarta');
                $hadir->jam = date('H:i:s');
                $hadir->status='absen';
                $hadir->save();

                $data = Absensi::where('id_user',session('magang.id'))
                ->where('tanggal',date('Y-m-d'))
                ->first();

                return view('magang.absensi.index',[
                    'page'=>'absensi',
                    'data'=>$data
                ]);
            }
            return view('magang.absensi.index',[
                'page'=>'absensi',
                'data'=>$data
            ]);
        }

        return view('magang.absensi.index',[
            'page'=>'absensi',
            'data'=>$data
        ]);
    }

    public function hadir(){

        $data=DataMagang::where('id_user',session('magang.id'))->first();
        $hadir=new Absensi();
        $hadir->id_user = $data->id_user;
        $hadir->nama = $data->nama;
        $hadir->alamat = $data->alamat;
        $hadir->tanggal = date('Y-m-d');
        date_default_timezone_set('Asia/Jakarta');
        $hadir->jam = date('H:i:s');
        $jam = date('H:i:s',strtotime('07:45:00'));
        $jam2 = date('H:i:s',strtotime('09:00:00'));
        $now = date('H:i:s');
        if ($now > $jam && $now <= $jam2){
            $hadir->status='telat';
        }else {
            $hadir->status='hadir';
        }

        $hadir->save();
        return redirect(route('magang.absensi'));

    }

    public function izin(Request $request){

        $data=DataMagang::where('id_user',session('magang.id'))->first();
        $izin=new Absensi();
        $izin->id_user = $data->id_user;
        $izin->nama = $data->nama;
        $izin->alamat = $data->alamat;
        $izin->tanggal = date('Y-m-d');
        date_default_timezone_set('Asia/Jakarta');
        $izin->jam = date('H:i:s');
        $izin->status='izin';
        $izin->keterangan = $request->keterangan;
        if(!empty($request->surat_izin)){
            $file_name = time().rand(100,99).".".$request->surat_izin->getClientOriginalExtension();
            $request->surat_izin->move(public_path().'/dist/img/suratIzin',$file_name);
            $path = $file_name;
            $izin->surat_izin = $path;
        }
        $izin->save();
        return redirect(route('magang.absensi'));

    }

    public function sakit(Request $request){

        $data=DataMagang::where('id_user',session('magang.id'))->first();
        $sakit=new Absensi();
        $sakit->id_user = $data->id_user;
        $sakit->nama = $data->nama;
        $sakit->alamat = $data->alamat;
        $sakit->tanggal = date('Y-m-d');
        date_default_timezone_set('Asia/Jakarta');
        $sakit->jam = date('H:i:s');
        $sakit->status='sakit';
        $sakit->keterangan = $request->keterangan;

        if(!empty($request->surat_izin)){
            $file_name = time().rand(100,99).".".$request->surat_izin->getClientOriginalExtension();
            $request->surat_izin->move(public_path().'/dist/img/suratIzin',$file_name);
            $path = $file_name;
            $sakit->surat_izin = $path;
        }

        $sakit->save();
        return redirect(route('magang.absensi'));

    }

}

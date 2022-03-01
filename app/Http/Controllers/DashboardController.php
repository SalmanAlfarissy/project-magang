<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Magang;
use App\Models\Absensi;
use App\Models\Aktivitas;
use App\Models\DataMagang;
use App\Models\Presentasi;
use Illuminate\Http\Request;
use Psy\VarDumper\Presenter;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        $admin=User::where('level','!=','magang')->count();
        $magang=User::where('level','magang')->count();
        $absensi=Absensi::count();
        $aktivitas=Aktivitas::count();
        $presentasi=Presentasi::count();

        return view('administrator.dashboard.index',[
            'page'=>'dashboard',
            'admin'=>$admin,
            'magang'=>$magang,
            'absensi'=>$absensi,
            'aktivitas'=>$aktivitas,
            'presentasi'=>$presentasi
        ]);
    }
    public function _index(){
        $data=DataMagang::where('id_user',session('magang.id'))->first();
        if(empty($data)){
            return redirect(route('magang.dataMagang'));
        }
        $absensi = Absensi::where('id_user',session('magang.id'))
        ->where('status','hadir')
        ->count();
        $magang = Magang::where('id_user',session('magang.id'))
        ->first();

        $aktivitas = Aktivitas::select('id_user',DB::raw("SUM(aktivitas.hasil) as jumlah"))
        ->where('nama_aktivitas','project')
        ->where('id_user',session('magang.id'))
        ->orderBy("aktivitas.created_at")
        ->groupBy(DB::raw("id_user"))
        ->first();

        return view('magang.dashboard.index',[
            'page'=>'dashboard',
            'absensi'=>$absensi,
            'aktivitas'=>$aktivitas,
            'magang'=>$magang
        ]);

    }
}

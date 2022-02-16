<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DataMagang;
use App\Models\Magang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $admin=User::where('level','!=','magang')->count();
        return view('administrator.dashboard.index',[
            'page'=>'dashboard',
            'admin'=>$admin
        ]);
    }
    public function _index(){
        $data=DataMagang::where('id_user',session('magang.id'))->first();
        if(empty($data)){
            return redirect(route('magang.dataMagang'));
        }

        return view('magang.dashboard.index',[
            'page'=>'dashboard',
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class _ProfileController extends Controller
{
    public function index(){

        $data=User::find(session('magang.id'));
        return view('magang.profil.magang',[
            'page'=>'profile',
            'data'=>$data
        ]);
    }
}

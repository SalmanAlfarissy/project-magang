<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;

class _AktivitasController extends Controller
{
    public function index(){
        return view('magang.aktivitas.index',[
            'page'=>'aktivitas'
        ]);
    }
    public function read(){
        $data=Aktivitas::where('id_user',session('magang.id'))->get();
        date_default_timezone_set('Asia/Jakarta');
        $date = date('Y-m-d');
        return view('magang.aktivitas.read',[
            'data'=>$data,
            'date'=>$date
        ]);
    }

    public function create(){
        return view('magang.aktivitas.create');
    }

    public function store(Request $request){
        $data=new Aktivitas();
        $validated=$request->validate([
            'nama_aktivitas'=>'required',
            'deskripsi'=>'required',
            'hasil'=>'required'

        ]);

        $data->id_user = session('magang.id');
        $data->nama_aktivitas = $validated['nama_aktivitas'];
        $data->deskripsi = $validated['deskripsi'];
        $data->hasil = $validated['hasil'];
        $data->save();
    }

    public function show($id){
        $data=Aktivitas::find($id);
        return view('magang.aktivitas.edit',[
            'data'=>$data
        ]);
    }

    public function update(Request $request,$id){
        $data=Aktivitas::find($id);
        $validated=$request->validate([
            'nama_aktivitas'=>'required',
            'deskripsi'=>'required',
            'hasil'=>'required'
        ]);

        $data->nama_aktivitas = $validated['nama_aktivitas'];
        $data->deskripsi = $validated['deskripsi'];
        $data->hasil = $validated['hasil'];
        $data->save();
    }

}

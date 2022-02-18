<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use App\Models\Aktivitas;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class AktivitasController extends Controller
{
    public function index(){
        $data = User::join('data_magang','data_magang.id_user','=','user.id')
        ->join('magang','magang.id_user','=','user.id')
        ->where('magang.status','diterima')
        ->select('user.*','data_magang.alamat')
        ->get();

        return view('administrator.aktivitas.index',[
            'page'=>'aktivitas',
            'data'=>$data
        ]);
    }

    public function data($id){
        $data=Aktivitas::where('id_user',$id)->get();
        $dataMagang = DataMagang::where('id_user',$id)->first();

        return view('administrator.aktivitas.data',[
            'page'=>'aktivitas',
            'data'=>$data,
            'dataMagang'=>$dataMagang
        ]);
    }

    public function create($id){
        $data = User::where('id',$id)->first();

        return view('administrator.aktivitas.create',[
            'data'=>$data
        ]);
    }

    public function store(Request $request){
        $data=new Aktivitas();
        $validated=$request->validate([
            'nama_aktivitas'=>'required',
            'deskripsi'=>'required',
            'hasil'=>'required',
            'nama'=>'required'
        ]);

        $data->id_user = $validated['nama'];
        $data->nama_aktivitas = $validated['nama_aktivitas'];
        $data->deskripsi = $validated['deskripsi'];
        $data->hasil = $validated['hasil'];
        $data->save();
    }

    public function show($id){
        $data=Aktivitas::find($id);
        $bio = User::where('id',$data->id_user)->first();
        return view('administrator.aktivitas.edit',[
            'data'=>$data,
            'bio'=>$bio
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

    public function destroy($id)
    {
        $data = Aktivitas::findOrFail($id);
        $data->delete();
    }

    public function cetak(){

        $data=Aktivitas::where('id_user',request()->id_user)->get();
        $dataMagang = DataMagang::where('id_user',request()->id_user)->first();

        $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadView('administrator.aktivitas.cetak', [
            'data'=>$data,
            'dataMagang'=>$dataMagang
        ]);
        return $pdf->stream();
    }
}

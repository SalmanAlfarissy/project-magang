<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class AbsensiController extends Controller
{
    public function index(){
        $data = User::join('data_magang','data_magang.id_user','=','user.id')
        ->join('magang','magang.id_user','=','user.id')
        ->where('magang.status','diterima')
        ->select('user.*','data_magang.alamat')
        ->get();

        return view('administrator.absensi.index',[
            'page'=>'absensi',
            'data'=>$data
        ]);
    }

    public function data($id){
        $data=Absensi::where('id_user',$id)->get();
        $dataMagang = DataMagang::where('id_user',$id)->first();
        // return $dataMagang;
        return view('administrator.absensi.data',[
            'page'=>'absensi',
            'data'=>$data,
            'dataMagang'=>$dataMagang
        ]);
    }

    public function create($id){
        $data = User::where('id',$id)->first();

        return view('administrator.absensi.create',[
            'data'=>$data
        ]);
    }

    public function store(Request $request){
        $data=new Absensi();
        $validated=$request->validate([
            'nama'=>'required',
            'status'=>'required'
        ]);
        $bio = DataMagang::where('id_user',$validated['nama'])->first();

        date_default_timezone_set('Asia/Jakarta');
        $data->id_user = $validated['nama'];
        $data->tanggal = date('Y-m-d');
        $data->jam = date('H:i:s');
        $data->nama = $bio->nama;
        $data->alamat = $bio->alamat;
        $data->status = $validated['status'];
        $data->save();
    }

    public function show($id){
        $data=Absensi::find($id);
        $absensi = Absensi::all();
        return view('administrator.absensi.edit',[
            'data'=>$data,
            'absensi'=>$absensi
        ]);
    }

    public function update(Request $request,$id){
        $data=Absensi::find($id);
        $validated=$request->validate([
            'status'=>'required'
        ]);
        $data->status = $validated['status'];
        $data->save();
    }

    public function destroy($id)
    {
        $data = Absensi::findOrFail($id);
        $data->delete();
    }

    public function cetak(){

        $data=Absensi::where('id_user',request()->id_user)->get();
        $dataMagang = DataMagang::where('id_user',request()->id_user)->first();

        $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadView('administrator.absensi.cetak', [
            'data'=>$data,
            'dataMagang'=>$dataMagang
        ]);
        return $pdf->stream();
    }
}

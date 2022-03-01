<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Presentasi;
use Illuminate\Http\Request;

class _PengajuanController extends Controller
{
    public function index(){
        $data = Pengajuan::where('id_user',session('magang.id'))->first();
        $presen = null;
        if (!empty($data)){
            $presen = Presentasi::join('user','user.id','=','presentasi.id_user')
            ->join('pengajuan','pengajuan.id','=','presentasi.id_pengajuan')
            ->where('id_pengajuan',$data->id)
            ->select('presentasi.*','user.name','pengajuan.judul')
            ->first();

            $presen=Presentasi::join('user','user.id','presentasi.id_user')
            ->join('pengajuan','pengajuan.id','presentasi.id_pengajuan')
            ->where('id_pengajuan',$data->id)->first();
        }


        // return $presen;
        return view('magang.pengajuan.index',[
            'page'=>'presentasi',
            'data'=>$data,
            'presen'=>$presen
        ]);
    }

    public function read(){
        $data=Pengajuan::where('id_user',session('magang.id'))->first();

        return view('magang.pengajuan.read',[
            'data'=>$data
        ]);
    }

    public function create(){
        return view('magang.pengajuan.create');
    }

    public function store(Request $request){
        $data=new Pengajuan();
        $validated=$request->validate([
            'judul'=>'required',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $data->id_user = session('magang.id');
        $data->judul = $validated['judul'];
        $data->tanggal_pengajuan = date('Y-m-d');
        $data->status_pengajuan = 'pengajuan';
        $data->save();

    }

    public function show($id){
        $data=Pengajuan::find($id);
        return view('magang.pengajuan.edit',[
            'data'=>$data
        ]);
    }

    public function update(Request $request,$id){
        $data=Pengajuan::find($id);
        $validated=$request->validate([
            'judul'=>'required',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $data->judul = $validated['judul'];
        $data->tanggal_pengajuan = date('Y-m-d');
        $data->save();
    }

    public function destroy($id)
    {
        $data = Pengajuan::findOrFail($id);
        $data->delete();
    }
}

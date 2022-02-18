<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Pengajuan;
use App\Models\Presentasi;
use Psy\VarDumper\Presenter;

class PresentasiController extends Controller
{
    public function index(){
        return view('administrator.presentasi.index',[
            'page'=>'presentasi'
        ]);
    }

    public function read(){
        $data=User::leftjoin('pengajuan','pengajuan.id_user','user.id')
        ->leftjoin('presentasi','presentasi.id_pengajuan','pengajuan.id')
        ->where('pengajuan.status_pengajuan','!=',null)
        ->select('user.name','user.username','pengajuan.*','presentasi.tanggal_presentasi','presentasi.link_zoom')
        ->get();

        // return $data;
        return view('administrator.presentasi.read',[
            'data'=>$data
        ]);
    }

    public function create(){

        // $data = Aktivitas::select('id_user',DB::raw("SUM(aktivitas.hasil) as jumlah"))
        // ->orderBy("aktivitas.created_at")
        // ->groupBy(DB::raw("id_user"))
        // ->get();

        $data = User::join('magang','magang.id_user','user.id')
        ->where('magang.status','diterima')
        ->where('user.level','magang')
        ->select('user.*','magang.status')
        ->get();
        // return $data;
        return view('administrator.presentasi.create',[
            'data'=>$data
        ]);
    }

    public function store(Request $request){
        $presen=new Pengajuan();
        $validated=$request->validate([
            'nama'=>'required',
            'judul'=>'required',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $presen->id_user = $validated['nama'];
        $presen->judul = $validated['judul'];
        $presen->tanggal_pengajuan = date('Y-m-d');
        $presen->status_pengajuan = 'pengajuan';
        $presen->save();

    }

    public function approv($id){

        $data=Pengajuan::find($id);
        $user=User::where('id',$data->id_user)->first();

        return view('administrator.presentasi.presentasi',[
            'data'=>$data,
            'user'=>$user
        ]);
    }

    public function save(Request $request){

        $validated=$request->validate([
            'id_pengajuan'=>'required',
            'status_pengajuan'=>'required',
            'tanggal_presentasi'=>'required',
            'link_zoom'=>'required'
        ]);
        $pengajuan=Pengajuan::find($validated['id_pengajuan']);

        $presen = new Presentasi();
        date_default_timezone_set('Asia/Jakarta');
        $presen->id_user = session('admin.id');
        $presen->id_pengajuan = $validated['id_pengajuan'];
        $presen->tanggal_presentasi = $validated['tanggal_presentasi'];
        $presen->link_zoom = $validated['link_zoom'];
        $presen->save();

        $pengajuan->status_pengajuan = $validated['status_pengajuan'];
        $pengajuan->save();

    }

    public function show($id){
        $user = User::where('level','!=','magang')->get();

        $presentasi=Presentasi::where('id_pengajuan',$id)->first();
        $pengajuan=Pengajuan::join('user','user.id','pengajuan.id_user')
        ->where('pengajuan.id',$id)
        ->select('user.name','pengajuan.*')
        ->first();

        return view('administrator.presentasi.edit',[
            'presentasi'=>$presentasi,
            'pengajuan'=>$pengajuan,
            'user'=>$user
        ]);
    }

    public function update(Request $request,$id){
        $pengajuan=Pengajuan::find($id);
        $validated=$request->validate([
            'nama_penguji'=>'required',
            'judul'=>'required',
            'status_pengajuan'=>'required',
            'tanggal_presentasi'=>'required',
            'link_zoom'=>'required'
        ]);

        $pengajuan->judul = $validated['judul'];
        $pengajuan->status_pengajuan = $validated['status_pengajuan'];
        $pengajuan->save();
        date_default_timezone_set('Asia/Jakarta');

        $presentasi = Presentasi::where('id_pengajuan',$id)->first();
        $presentasi->id_user = $validated['nama_penguji'];
        $presentasi->tanggal_presentasi = $validated['tanggal_presentasi'];
        $presentasi->link_zoom = $validated['link_zoom'];
        // return $presentasi;
        $presentasi->save();

    }

    public function destroy($id)
    {
        $data = Pengajuan::join('presentasi','presentasi.id_pengajuan','pengajuan.id')
        ->where('pengajuan.id',$id)
        ->select('presentasi.*','pengajuan.*')
        ->first();
        // return $data;
        $data->delete();


    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Magang;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class MagangController extends Controller
{
    public function indexRecipient(){
        return view('administrator.magang.recipient.index',[
            'page'=>'recipient'
        ]);
    }
    public function readRecipient(){
        $data=User::join('magang','magang.id_user','=','user.id')
        ->select('user.name','user.username','magang.*')
        ->get();

        return view('administrator.magang.recipient.read',[
            'data'=>$data
        ]);
    }

    public function createRecipient(){
        $magang=User::leftJoin('magang','magang.id_user','=','user.id')
        ->where('user.level','=','magang')
        ->where('magang.status','=',null)
        ->select('user.*','magang.status')
        ->get();

        return view('administrator.magang.recipient.create',[
            'magang'=>$magang
        ]);
    }

    public function storeRecipient(Request $request){


        $validated=$request->validate([
            'id_user'=>'required',
            'status'=>'required',
            'deskripsi'=>'',
        ]);

        $magang=Magang::where('id_user',$validated['id_user'])->first();
        if(empty($magang)){
            $magang = new Magang();
        }

        $magang->id_user = $validated['id_user'];
        $magang->status = $validated['status'];
        $magang->deskripsi = $validated['deskripsi'];
        $magang->save();

    }


    public function showRecipient($id){
        $data=User::join('magang','magang.id_user','=','user.id')
        ->where('magang.id',$id)
        ->select('user.name','user.username','magang.*')
        ->first();

        return view('administrator.magang.recipient.edit',[
            'data'=>$data
        ]);
    }

    public function updateRecipient(Request $request,$id){
        $data=Magang::find($id);
        $validated=$request->validate([
            'status'=>'required',
            'deskripsi'=>'required'
        ]);

        $data->status = $validated['status'];
        $data->deskripsi = $validated['deskripsi'];

        $data->save();
    }

    public function destroyRecipient($id)
    {
        $data = Magang::findOrFail($id);
        $data->delete();
    }

    //list

    public function indexList(){
        return view('administrator.magang.list.index',[
            'page'=>'list'
        ]);
    }
    public function readList(){
        // $data=User::join('magang','magang.id_user','=','user.id')
        // ->join('data_magang','data_magang.id_user','=','user.id')
        // ->select('user.username','magang.status','data_magang.*')
        // ->where('magang.status','diterima')
        // ->get();

        $data = User::leftJoin('magang','magang.id_user','=','user.id')
        ->leftJoin('data_magang','data_magang.id_user','=','user.id')
        ->where('user.level','=','magang')
        ->where('magang.status','=','diterima')
        ->select('user.*','magang.status','data_magang.alamat','data_magang.awal_magang','data_magang.selesai_magang')
        ->get();

        // return $data;

        return view('administrator.magang.list.read',[
            'data'=>$data
        ]);
    }

    public function createList(){
        return view('administrator.magang.list.create');
    }

    public function storeList(Request $request){
        $user=new User();
        $validated=$request->validate([
            'name'=>'required',
            'username'=>'required|max:255|unique:user',
            'password'=>'required|min:5|max:255',
        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->password = Hash::make($validated['password']);
        $user->level = 'magang';
        $user->save();
    }

    public function showList($id){
        $data=User::leftJoin('magang','magang.id_user','=','user.id')
        ->leftJoin('data_magang','data_magang.id_user','=','user.id')
        ->where('user.level','=','magang')
        ->where('magang.status','=','diterima')
        ->where('user.id',$id)
        ->select('user.*','magang.status','data_magang.alamat','data_magang.awal_magang','data_magang.selesai_magang')
        ->first();
        // return $data;

        return view('administrator.magang.list.edit',[
            'data'=>$data
        ]);
    }

    public function updateList(Request $request,$id){
        $user=User::find($id);
        $validated=$request->validate([

            'name'=>'required',
            'username'=>'required|max:255',

        ]);

        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->save();
    }

    public function data($id){
        $data=User::leftJoin('magang','magang.id_user','=','user.id')
        ->leftJoin('data_magang','data_magang.id_user','=','user.id')
        ->where('user.level','=','magang')
        ->where('magang.status','=','diterima')
        ->where('user.id',$id)
        ->select('user.*','magang.status','data_magang.alamat','data_magang.awal_magang','data_magang.selesai_magang')
        ->first();
        // return $data;

        return view('administrator.magang.list.data',[
            'data'=>$data
        ]);
    }

    public function updateData(Request $request,$id){
        $dataMagang=DataMagang::where('id_user',$id)->first();
        // return $dataMagang;
        if(empty($dataMagang)){
            $dataMagang=new DataMagang();
        }

        $user=User::find($id);
        $validated=$request->validate([
            'alamat'=>'required',
            'awal_magang'=>'required',
            'selesai_magang'=>'required',
        ]);

        $dataMagang->nama=$user->name;
        $dataMagang->id_user=$user->id;
        $dataMagang->alamat=$validated['alamat'];
        $dataMagang->awal_magang=$validated['awal_magang'];
        $dataMagang->selesai_magang=$validated['selesai_magang'];

        $dataMagang->save();
    }


    public function destroyList($id)
    {
        $user = User::findOrFail($id);
        $dataMagang = DataMagang::where('id_user',$id);
        $magang = Magang::where('id_user',$id);
        $dataMagang->delete();
        $magang->delete();
        $user->delete();
    }

    public function cetak(){

        $data = User::leftJoin('magang','magang.id_user','=','user.id')
        ->leftJoin('data_magang','data_magang.id_user','=','user.id')
        ->where('user.level','=','magang')
        ->where('magang.status','=','diterima')
        ->select('user.*','magang.status','data_magang.alamat','data_magang.awal_magang','data_magang.selesai_magang')
        ->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadView('administrator.magang.list.cetak', [
            'data'=>$data
        ]);
        return $pdf->stream();
    }


}

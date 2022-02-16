<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\DataMagang;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(){
        return view('administrator.absensi.index',[
            'page'=>'absensi'
        ]);
    }
    public function read(){
        $data=Absensi::all();
        return view('administrator.absensi.read',[
            'data'=>$data
        ]);
    }

    public function create(){
        $data = User::all();
        return view('administrator.absensi.create',[
            'data'=>$data
        ]);
    }

    public function store(Request $request){
        $data=new Absensi();
        $validated=$request->validate([
            'id_user'=>'required',
            'status'=>'required'
        ]);
        $bio = DataMagang::where('id_user',$validated['id_user'])->first();

        $data->id_user = $validated['id_user'];
        $data->nama = $bio->nama;
        $data->alamat = $bio->alamat;
        $data->status = $validated['status'];
        $data->save();
    }

    public function show($id){
        $data=User::find($id);
        return view('administrator.admin.edit',[
            'data'=>$data
        ]);
    }

    public function update(Request $request,$id){
        $data=User::find($id);
        $validated=$request->validate([
            'name'=>'required',
            'username'=>'required|max:255',
            'level'=>'required'
        ]);

        $data->name = $validated['name'];
        $data->username = $validated['username'];
        $data->level = $validated['level'];
        $data->save();
    }

    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }
}

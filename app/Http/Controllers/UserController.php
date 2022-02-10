<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        return view('administrator.admin.index',[
            'page'=>'user'
        ]);
    }
    public function read(){
        $data=User::where('level','!=','magang')->get();
        return view('administrator.admin.read',[
            'data'=>$data
        ]);
    }

    public function create(){
        return view('administrator.admin.create');
    }

    public function store(Request $request){
        $data=new User();
        $validated=$request->validate([
            'name'=>'required',
            'username'=>'required|max:255|unique:user',
            'password'=>'required|min:5|max:255',
            'level'=>'required'
        ]);

        $data->name = $validated['name'];
        $data->username = $validated['username'];
        $data->password = Hash::make($validated['password']);
        $data->level = $validated['level'];
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

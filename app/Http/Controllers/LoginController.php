<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function admin(){
        if(!empty(session('admin'))){
            return redirect(route('admin.das'));
        }
        return view('login.admin');
    }

    public function autadmin(Request $request){
        $validate=$request->validate([
            'username'=>'required',
            'password'=>'required|min:5|max:255'
        ]);

        $auth=User::where('username',$validate['username'])->first();

        if(!empty($auth)){
            if(Hash::check($validate['password'],$auth->password)){
                if($auth->level == 'administrator' || $auth->level == 'pimpinan' || $auth->level == 'staf'){
                    session()->put([
                        'admin'=>[
                            'id'=>$auth->id,
                            'level'=>$auth->level,
                            'name'=>$auth->name
                        ]
                    ]);
                    return redirect(route('admin.das'));
                }
            }
        }
        return back()->with('LoginError','Login Failed!!');

    }

    public function logout(){
        session()->flush();
        return redirect(route('admin.login'));
    }
}

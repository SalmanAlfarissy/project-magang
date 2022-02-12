<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataMagang;
use App\Models\Magang;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;

class _LoginController extends Controller
{
    public function register(){
        return view('register.magang');
    }

    public function registerStore(Request $request){
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

        return redirect(route('magang.login'));
    }

    public function dataMagang(){
        return view('register.dataMagang');
    }

    public function dataStore(Request $request){
        $data=new DataMagang();
        $validated=$request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'tanggal_lahir'=>'required',
            'awal_magang'=>'required',
            'selesai_magang'=>'required',
            'foto'=>'required|image|max:512|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $data->id_user = $request->id;
        $data->nama = $validated['nama'];
        $data->alamat = $validated['alamat'];
        $data->tanggal_lahir = date('Y-d-m',strtotime($validated['tanggal_lahir']));
        $data->awal_magang = date('Y-d-m',strtotime($validated['awal_magang']));
        $data->selesai_magang = date('Y-d-m',strtotime($validated['selesai_magang']));

        $file_name = time().rand(100,99).".".$validated['foto']->getClientOriginalExtension();
        $validated['foto']->move(public_path().'/dist/img/magang',$file_name);
        $path = $file_name;
        $data -> foto = $path;

        $data->save();

        $status = new Magang();
        $status->id_user = $request->id;
        $status->status = 'pengajuan';
        $status->save();

        return redirect(route('magang.das'));

    }

    public function magang(){
        if(!empty(session('magang'))){
            return redirect(route('magang.das'));
        }
        return view('login.magang');
    }

    public function autmagang(Request $request){
        $validate=$request->validate([
            'username'=>'required',
            'password'=>'required|min:5|max:255'
        ]);

        $auth=User::join('data_magang','data_magang.id_user','=','user.id')
        ->where('username',$validate['username'])
        ->select('user.*','data_magang.foto')
        ->first();

        if(!empty($auth)){
            if(Hash::check($validate['password'],$auth->password)){
                if($auth->level == 'magang'){
                    session()->put([
                        'magang'=>[
                            'id'=>$auth->id,
                            'level'=>$auth->level,
                            'name'=>$auth->name,
                            'foto'=>$auth->foto
                        ]
                    ]);
                    $data=DataMagang::where('id_user',$auth->id)->first();

                    if(empty($data)){
                        return redirect(route('magang.dataMagang'));
                    }
                    return redirect(route('magang.das'));
                }
            }
        }
        return back()->with('LoginError','Login Failed!!');

    }

    public function logout(){
        session()->flush();
        return redirect(route('magang.login'));
    }
}

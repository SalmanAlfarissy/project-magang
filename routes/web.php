<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\_LoginController;
use App\Http\Controllers\MagangController;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\_AbsensiController;
use App\Http\Controllers\_ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\_AktivitasController;
use App\Http\Controllers\_PengajuanController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\PresentasiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// fitur admin

Route::get('/',function(){
    return redirect(route('magang.login'));
});

Route::group(['middleware'=>['admin'],'prefix'=>'/administrator'],function(){
    //dashboard
    Route::get('/',[DashboardController::class,'index'])->name('admin.das');

    //add new user admin
    Route::prefix('/user')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('admin.user');
        Route::get('/create',[UserController::class,'create'])->name('admin.user-create');
        Route::get('/read',[UserController::class,'read'])->name('admin.user-read');
        Route::post('/store',[UserController::class,'store'])->name('admin.user-store');
        Route::get('/show/{id}',[UserController::class,'show'])->name('admin.user-show');
        Route::post('/update/{id}',[UserController::class,'update'])->name('admin.user-update');
        Route::get('/destroy/{id}',[UserController::class,'destroy'])->name('admin.user-destroy');
    });


    Route::prefix('/magang')->group(function(){
        //Recipient Magang
        Route::prefix('/recipient')->group(function(){
            Route::get('/',[MagangController::class,'indexRecipient'])->name('admin.recipient');
            Route::get('/create',[MagangController::class,'createRecipient'])->name('admin.recipient-create');
            Route::get('/read',[MagangController::class,'readRecipient'])->name('admin.recipient-read');
            Route::post('/store',[MagangController::class,'storeRecipient'])->name('admin.recipient-store');
            Route::get('/show/{id}',[MagangController::class,'showRecipient'])->name('admin.recipient-show');
            Route::post('/update/{id}',[MagangController::class,'updateRecipient'])->name('admin.recipient-update');
            Route::get('/destroy/{id}',[MagangController::class,'destroyRecipient'])->name('admin.recipient-destroy');
        });
        //List Magang
        Route::prefix('/list')->group(function(){
            Route::get('/',[MagangController::class,'indexList'])->name('admin.list');
            Route::get('/create',[MagangController::class,'createList'])->name('admin.list-create');
            Route::get('/read',[MagangController::class,'readList'])->name('admin.list-read');
            Route::post('/store',[MagangController::class,'storeList'])->name('admin.list-store');
            Route::get('/show/{id}',[MagangController::class,'showList'])->name('admin.list-show');
            Route::post('/update/{id}',[MagangController::class,'updateList'])->name('admin.list-update');
            Route::get('/data/{id}',[MagangController::class,'data'])->name('admin.data-show');
            Route::post('/updateData/{id}',[MagangController::class,'updateData'])->name('admin.data-update');
            Route::get('/destroy/{id}',[MagangController::class,'destroyList'])->name('admin.list-destroy');
            Route::get('/cetak',[MagangController::class,'cetak'])->name('admin.list-cetak');
        });
    });

    //absensi
    Route::prefix('/absensi')->group(function(){
        Route::get('/',[AbsensiController::class,'index'])->name('admin.absensi');
        Route::get('/create/{id}',[AbsensiController::class,'create'])->name('admin.absensi-create');
        Route::get('/data/{id}',[AbsensiController::class,'data'])->name('admin.absensi-data');
        Route::post('/store',[AbsensiController::class,'store'])->name('admin.absensi-store');
        Route::get('/show/{id}',[AbsensiController::class,'show'])->name('admin.absensi-show');
        Route::post('/update/{id}',[AbsensiController::class,'update'])->name('admin.absensi-update');
        Route::get('/destroy/{id}',[AbsensiController::class,'destroy'])->name('admin.absensi-destroy');
        Route::get('/cetak',[AbsensiController::class,'cetak'])->name('admin.absensi-cetak');
    });

    //aktivitas
    Route::prefix('/aktivitas')->group(function(){
        Route::get('/',[AktivitasController::class,'index'])->name('admin.aktivitas');
        Route::get('/create/{id}',[AktivitasController::class,'create'])->name('admin.aktivitas-create');
        Route::get('/data/{id}',[AktivitasController::class,'data'])->name('admin.aktivitas-data');
        Route::post('/store',[AktivitasController::class,'store'])->name('admin.aktivitas-store');
        Route::get('/show/{id}',[AktivitasController::class,'show'])->name('admin.aktivitas-show');
        Route::post('/update/{id}',[AktivitasController::class,'update'])->name('admin.aktivitas-update');
        Route::get('/destroy/{id}',[AktivitasController::class,'destroy'])->name('admin.aktivitas-destroy');
        Route::get('/cetak',[AktivitasController::class,'cetak'])->name('admin.aktivitas-cetak');
    });

    //Presentasi
    Route::prefix('/presentasi')->group(function(){
        Route::get('/',[PresentasiController::class,'index'])->name('admin.presentasi');
        Route::get('/create',[PresentasiController::class,'create'])->name('admin.presentasi-create');
        Route::get('/approv/{id}',[PresentasiController::class,'approv'])->name('admin.presentasi-approv');
        Route::post('/save',[PresentasiController::class,'save'])->name('admin.presentasi-save');
        Route::get('/read',[PresentasiController::class,'read'])->name('admin.presentasi-read');
        Route::post('/store',[PresentasiController::class,'store'])->name('admin.presentasi-store');
        Route::get('/show/{id}',[PresentasiController::class,'show'])->name('admin.presentasi-show');
        Route::post('/update/{id}',[PresentasiController::class,'update'])->name('admin.presentasi-update');
        Route::get('/destroy/{id}',[PresentasiController::class,'destroy'])->name('admin.presentasi-destroy');
    });

});

//login
Route::get('/admin/login',[LoginController::class,'admin'])->name('admin.login');
Route::post('/admin/login/auth',[LoginController::class,'autadmin'])->name('admin.autadmin');

//logout
Route::get('/admin/logout',[LoginController::class,'logout'])->name('admin.logout');

//=================================================================================================//
//fitur magang
Route::group(['middleware'=>['magang'],'prefix'=>'/magang'],function(){
    Route::get('/',[DashboardController::class,'_index'])->name('magang.das');
    Route::get('/profile',[_ProfileController::class,'index'])->name('magang.profile');
    Route::get('/datamagang',[_LoginController::class,'dataMagang'])->name('magang.dataMagang');
    Route::post('/datamagang/store',[_LoginController::class,'dataStore'])->name('magang.dataMagang-store');

    //absensi
    Route::prefix('/absensi')->group(function(){
        Route::get('/',[_AbsensiController::class,'index'])->name('magang.absensi');
        Route::get('/hadir',[_AbsensiController::class,'hadir'])->name('magang.hadir');
        Route::post('/izin',[_AbsensiController::class,'izin'])->name('magang.izin');
        Route::post('/sakit',[_AbsensiController::class,'sakit'])->name('magang.sakit');
        Route::get('/telat',[_AbsensiController::class,'telat'])->name('magang.telat');
        Route::get('/absen',[_AbsensiController::class,'absen'])->name('magang.absen');
    });

    //aktivitas
    Route::prefix('/aktivitas')->group(function(){
        Route::get('/',[_AktivitasController::class,'index'])->name('magang.aktivitas');
        Route::get('/create',[_AktivitasController::class,'create'])->name('magang.aktivitas-create');
        Route::get('/read',[_AktivitasController::class,'read'])->name('magang.aktivitas-read');
        Route::post('/store',[_AktivitasController::class,'store'])->name('magang.aktivitas-store');
        Route::get('/show/{id}',[_AktivitasController::class,'show'])->name('magang.aktivitas-show');
        Route::post('/update/{id}',[_AktivitasController::class,'update'])->name('magang.aktivitas-update');

    });

    //presentasi
    Route::prefix('/presentasi')->group(function(){
        Route::get('/',[_PengajuanController::class,'index'])->name('magang.pengajuan');
        Route::get('/create',[_PengajuanController::class,'create'])->name('magang.pengajuan-create');
        Route::get('/read',[_PengajuanController::class,'read'])->name('magang.pengajuan-read');
        Route::post('/store',[_PengajuanController::class,'store'])->name('magang.pengajuan-store');
        Route::get('/show/{id}',[_PengajuanController::class,'show'])->name('magang.pengajuan-show');
        Route::post('/update/{id}',[_PengajuanController::class,'update'])->name('magang.pengajuan-update');
        Route::get('/destroy/{id}',[_PengajuanController::class,'destroy'])->name('magang.pengajuan-destroy');
    });
});

//register
Route::get('/magang/register',[_LoginController::class,'register'])->name('magang.register');
Route::post('/magang/register/store',[_LoginController::class,'registerStore'])->name('magang.register-store');


//login
Route::get('/magang/login',[_LoginController::class,'magang'])->name('magang.login');
Route::post('/magang/login/auth',[_LoginController::class,'autmagang'])->name('magang.autmagang');

//logout
Route::get('/magang/logout',[_LoginController::class,'logout'])->name('magang.logout');



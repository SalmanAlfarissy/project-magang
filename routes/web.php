<?php

use App\Http\Controllers\_LoginController;
use App\Http\Controllers\_ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect(route('admin.login'));
});

// fitur admin

//add new admin
Route::group(['middleware'=>['admin'],'prefix'=>'/administrator'],function(){
    Route::get('/',[DashboardController::class,'index'])->name('admin.das');
    Route::prefix('/user')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('admin.user');
        Route::get('/create',[UserController::class,'create'])->name('admin.user-create');
        Route::get('/read',[UserController::class,'read'])->name('admin.user-read');
        Route::post('/store',[UserController::class,'store'])->name('admin.user-store');
        Route::get('/show/{id}',[UserController::class,'show'])->name('admin.user-show');
        Route::post('/update/{id}',[UserController::class,'update'])->name('admin.user-update');
        Route::get('/destroy/{id}',[UserController::class,'destroy'])->name('admin.user-destroy');
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
});

//register
Route::get('/magang/register',[_LoginController::class,'register'])->name('magang.register');
Route::post('/magang/register/store',[_LoginController::class,'registerStore'])->name('magang.register-store');


//login
Route::get('/magang/login',[_LoginController::class,'magang'])->name('magang.login');
Route::post('/magang/login/auth',[_LoginController::class,'autmagang'])->name('magang.autmagang');

//logout
Route::get('/magang/logout',[_LoginController::class,'logout'])->name('magang.logout');



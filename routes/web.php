<?php

use App\Http\Controllers\DashboardController;
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
    return redirect(route('admin.das'));
});
Route::get('/administrator',[DashboardController::class,'index'])->name('admin.das');
Route::get('/administrator/user',[UserController::class,'index'])->name('admin.user');
Route::get('/administrator/user/create',[UserController::class,'create'])->name('admin.user-create');
Route::get('/administrator/user/read',[UserController::class,'read'])->name('admin.user-read');
Route::post('/administrator/user/store',[UserController::class,'store'])->name('admin.user-store');
Route::get('/administrator/user/show/{id}',[UserController::class,'show'])->name('admin.user-show');
Route::post('/administrator/user/update/{id}',[UserController::class,'update'])->name('admin.user-update');
Route::get('/administrator/user/destroy/{id}',[UserController::class,'destroy'])->name('admin.user-destroy');


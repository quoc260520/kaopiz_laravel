<?php

use App\Http\Controllers\HomeController;
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
    return view('welcome');
})->name('welcome');
Route::middleware('check.token')->get('/home',[HomeController::class,'index'])->name('home');
Route::get('/blade-view',function(){
    return view('blade_view.content');
})->name('blade-view');

Route::get('login',[HomeController::class,'login'])->name('login');
Route::post('login',[HomeController::class,'postLogin'])->name('login');
Route::get('register',[HomeController::class,'register'])->name('register');
Route::post('register',[HomeController::class,'postRegister'])->name('register');
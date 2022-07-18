<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserOrmController;
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

Route::get('/index', function () {
    return view('welcome');
})->name('welcome');
Route::middleware('check.token')->get('/home',[HomeController::class,'index'])->name('home');
Route::get('/blade-view',function(){
    return view('blade_view.content');
})->name('blade-view');

Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('login',[HomeController::class,'login'])->name('login');
Route::post('login',[HomeController::class,'postLogin'])->name('login');
Route::get('register',[HomeController::class,'register'])->name('register');
Route::post('register',[HomeController::class,'postRegister'])->name('register');
Route::get('logout',[HomeController::class,'logout'])->name('logout');
Route::get('detail/{id}',[HomeController::class,'detail'])->name('detail');
Route::post('comment/{id}',[HomeController::class,'comment'])->name('comment');

Route::middleware('check.login')->group(function(){
    Route::get('create-post',[HomeController::class,'getCreatePost'])->name('create.post');
    Route::post('create-post',[HomeController::class,'postCreatePost'])->name('create.post');
    Route::get('edit-post/{id}',[HomeController::class,'getEditPost'])->name('edit.post');
    Route::post('edit-post',[HomeController::class,'postEditPost'])->name('post.edit');
    Route::get('delete-post/{id}',[HomeController::class,'deletePost'])->name('delete.post');
    Route::get('list-post',[HomeController::class,'getListPost'])->name('list.post');
    Route::get('show-detail/{id}',[HomeController::class,'showDetail'])->name('show.detail');
    Route::get('user',[UserOrmController::class,'user'])->name('user');
    Route::post('user',[UserOrmController::class,'user'])->name('user');
    Route::get('user_tp2',[UserOrmController::class,'user_tp2'])->name('user_tp2');
    Route::post('user_tp2',[UserOrmController::class,'user_tp2'])->name('user_tp2');
});

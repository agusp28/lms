<?php

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
});

Auth::routes();

Route::get('/home', function(){
	if (Auth::check() && Auth::user()->level == "pengajar") {
		return redirect('pengajar');
	}elseif (Auth::check() && Auth::user()->level == "peserta") {
		return redirect('peserta');
	}
	elseif (Auth::check() && Auth::user()->level == "admin") {
		return redirect('admin/dashboard');
	}else{
		return redirect()->route('login');
	}
})->name('home');

Route::group(['prefix'=>'pengajar','middleware'=>'pengajar'],function(){
	Route::get('/','PengajarController@index');
});

Route::group(['prefix'=>'peserta','middleware'=>'peserta'],function(){
	Route::get('/','PesertaController@index');
});

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
	Route::get('dashboard','AdminController@index');
});

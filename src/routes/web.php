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
    return view('index');
});

Route::get('/mypage', function () {
    return view('mypage');
});

Route::get('/registry', function () {
    return view('registry');
});

Route::get('/mypage/profile', function () {
    return view('profile');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/detail', function () {
    return view('detail');
});

Route::get('/purchace', function () {
    return view('purchace');
});

Route::get('/address', function () {
    return view('address');
});

Route::get('/sell',function(){
    return view('sell');
});

Route::get('/auth',function(){
    return view('auth');
});
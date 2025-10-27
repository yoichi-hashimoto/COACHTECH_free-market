<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'index'])->name('index');

Route::middleware('guest')->group(function(){

    Route::get('/login',[UserController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login',[UserController::class, 'login'])
        ->name('login')
        ->middleware('throttle:login');

    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [UserController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function(){
    Route::get('/mypage', fn () 
    => view('mypage'))->name('mypage');

    Route::get('/mypage/profile', fn ()
    => view('profile'));

    Route::get('/detail', fn () 
    =>view('detail'));

    Route::get('/purchace', fn () 
    => view('purchace'));

    Route::get('/address', fn () 
    => view('address'));

    Route::get('/sell',fn()
    => view('sell'));

    Route::post('/logout',[UserController::class, 'logout'])->name('logout');

    });

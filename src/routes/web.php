<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

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

    Route::get('/login',[UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login',[UserController::class, 'login'])
        ->name('login.perform')
        ->middleware('throttle:6,1');

    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.perform');
});

Route::middleware('auth')->group(function(){

    Route::get('/mypage', [UserController::class,'mypage'])->name('mypage');

    Route::get('/mypage/profile', fn ()
    => view('profile'));

    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/detail', fn () 
    =>view('detail'));

    Route::get('/purchace', fn () 
    => view('purchace'));

    Route::get('/address', fn () 
    => view('address'));

    Route::get('/sell',fn()
    => view('sell'))-> name('sell');

    Route::post('/logout',[UserController::class, 'logout'])->name('logout');

    });

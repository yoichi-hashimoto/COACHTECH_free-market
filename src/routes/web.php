<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;

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
Route::get('/item/{item}',[ItemController::class,'show'])->name('item');


Route::middleware('guest')->group(function(){

    Route::get('/login',[UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login',[UserController::class, 'login'])
        ->name('login.perform')
        ->middleware('throttle:6,1');

    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.perform');

});

Route::middleware('auth')->group(function(){

    Route::get('/mylist', [UserController::class, 'mylist'])->name('mylist');

    Route::get('/mypage', [UserController::class,'mypage'])->name('mypage');

    Route::get('/mypage/profile', fn ()
    => view('profile'));


    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/detail', fn () 
    =>view('detail'));


    Route::get('/purchase', [PurchaseController::class,'address'])->name('purchase');


    Route::get('/address', fn () 
    => view('address'));

    Route::get('/sell', [ExhibitionController::class, 'create'])->name('sell');
    Route::post('/sell', [ExhibitionController::class, 'store'])->name('sell.store');
    Route::get('/sell/{item}/edit', [ExhibitionController::class, 'edit'])->name('sell.edit');
    Route::put('/sell/{item}',      [ExhibitionController::class, 'update'])->name('sell.update');

    Route::post('/item/{item}/like',[LikeController::class,'toggle'])->name('item.like');
    Route::post('/item/{item}/comment',[CommentController::class,'store'])->name('comment.store');

    Route::post('/logout',[UserController::class, 'logout'])->name('logout');

    });

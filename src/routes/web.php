<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CommentController;
<<<<<<< Updated upstream
=======
use App\Http\Controllers\MailController;
use App\Http\Middleware\EmailVerified;
use App\Http\Controllers\StripeController;
>>>>>>> Stashed changes

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
<<<<<<< Updated upstream

=======
Route::get('/auth',[MailController::class,'showAuth'])->name('auth');
Route::get('/purchase/success', [PurchaseController::class,'success'])->name('purchase.success');
>>>>>>> Stashed changes

Route::middleware('guest')->group(function(){

    Route::get('/login',[UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login',[UserController::class, 'login'])
        ->name('login.perform')
        ->middleware('throttle:6,1');

    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.perform');

});

Route::middleware('auth')->group(function(){

<<<<<<< Updated upstream
=======
Route::middleware('auth','verified_email')->group(function(){

    Route::get('/home', [UserController::class, 'index'])->name('home');
>>>>>>> Stashed changes
    Route::get('/mylist', [UserController::class, 'mylist'])->name('mylist');

    Route::get('/mypage', [UserController::class,'mypage'])->name('mypage');

    Route::get('/mypage/profile', fn ()
    => view('profile'));


    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/detail', fn () 
    =>view('detail'));


<<<<<<< Updated upstream
    Route::get('/purchase', [PurchaseController::class,'address'])->name('purchase');


    Route::get('/address', fn () 
    => view('address'));

    Route::get('/sell', [ExhibitionController::class, 'create'])->name('sell');
    Route::post('/sell', [ExhibitionController::class, 'store'])->name('sell.store');
    Route::get('/sell/{item}/edit', [ExhibitionController::class, 'edit'])->name('sell.edit');
    Route::put('/sell/{item}',      [ExhibitionController::class, 'update'])->name('sell.update');
=======
    Route::get('/purchase/cancel', fn () => view('purchase_cancel'))->name('purchase.cancel');

    Route::get('/address', [PurchaseController::class,'edit'])->name('address.edit');
    Route::post('/address', [PurchaseController::class,'update'])->name('address.update');

    Route::get('/sell', [ExhibitionController::class, 'create'])->name('sell');
    Route::post('/sell', [ExhibitionController::class, 'store'])->name('sell.store');
>>>>>>> Stashed changes

    Route::post('/item/{item}/like',[LikeController::class,'toggle'])->name('item.like');
    Route::post('/item/{item}/comment',[CommentController::class,'store'])->name('comment.store');

<<<<<<< Updated upstream
    Route::post('/logout',[UserController::class, 'logout'])->name('logout');
=======
    Route::post('/charge',[StripeController::class,'charge'])->name('charge');
>>>>>>> Stashed changes

    });

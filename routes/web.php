<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ImageController;



Route::get('/', function () {
    return view('register');
})->name('register');;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::prefix('user')->middleware(['user'])->group(function () {
    
    Route::get('/', [UserController::class,'index'])->name('user');
    Route::get('/upload', [ImageController::class, 'index']);
    Route::post('/upload', [ImageController::class, 'upload']);
    Route::get('/images', [ImageController::class, 'show']);
    Route::delete('/images/{id}', [ImageController::class, 'destroy']);
});


Route::post('/register', [RegisterController::class,'index']);
Route::post('/login', [LoginController::class,'index']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


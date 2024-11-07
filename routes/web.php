<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KontenController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'guest'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('form', [FormController::class, 'index'])->name('form');
    Route::get('register', [FormController::class, 'register'])->name('register'); // Registration view
    Route::get('/signup', function () { return view('signup');})->name('signup');
    Route::post('proses-register', [FormController::class, 'prosesRegister'])->name('prosesRegister'); // Handle registration POST
    Route::post('login', [FormController::class, 'login'])->name('login'); // Handle login POST
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [FormController::class, 'logout'])->name('logout');
    Route::resource('/profil', ContentController::class);
    Route::resource('/konten', KontenController::class);
    Route::post('/like/{id}', [ContentController::class, 'like'])->name('like');
    Route::post('/comment/{contentId}', [ContentController::class, 'comment'])->name('comment');
    Route::delete('/content/{id}', [ContentController::class, 'destroy'])->name('content.delete');

    Route::get('/content/{id}/edit', [ContentController::class, 'edit'])->name('content.edit');
    Route::put('/proses/{id}', [ContentController::class, 'update'])->name('content.update');


});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\PinjamController;
use App\Http\Controllers\Api\ProfileController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');    
});

Route::prefix('posts')->middleware('auth:api')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');    
    Route::get('/{id}', [PostController::class, 'show'])->name('show');    
    Route::post('/', [PostController::class, 'store'])->name('store');    
    Route::put('/{id}', [PostController::class, 'update'])->name('update');   
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');    
});

Route::prefix('books')->middleware('auth:api')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('index');    
    Route::get('/stok', [BookController::class, 'index'])->name('index');    
    Route::get('/{id}', [BookController::class, 'show'])->name('show');    
    Route::post('/', [BookController::class, 'store'])->name('store');    
    Route::put('/{id}', [BookController::class, 'update'])->name('update');   
    Route::delete('/{id}', [BookController::class, 'destroy'])->name('destroy');    
});

Route::prefix('pinjam')->middleware('auth:api')->group(function () {
    Route::get('/', [PinjamController::class, 'index'])->name('index');    
    Route::get('/{id}', [PinjamController::class, 'show'])->name('show');    
    Route::post('/', [PinjamController::class, 'store'])->name('store');    
    Route::put('/{id}', [PinjamController::class, 'update'])->name('update');   
    Route::delete('/{id}', [PinjamController::class, 'destroy'])->name('destroy');    
});

Route::prefix('users')->middleware('auth:api')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');   
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
});

Route::prefix('profile')->middleware('auth:api')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');  
});
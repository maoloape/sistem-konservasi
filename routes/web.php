<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CrudUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest'])->group(function(){
    //Login Sistem Guest
    Route::get('/',[HomeController::class,'index']);
    Route::get('/admin',[UserController::class,'index'])->name('login');
    Route::post('/admin',[UserController::class,'login']);
});

Route::middleware(['auth'])->group(function(){
    //Login Sistem Auth
    Route::get('/home',[AdminController::class,'index']);
    Route::get('/logout',[UserController::class,'logout']);

    // Crud User
    Route::get('/User-Account',[CrudUserController::class,'index']);
    Route::post('/User-Account/store',[CrudUserController::class,'store']);
    Route::post('/User-Account/update/{id}',[CrudUserController::class,'update']);
    Route::get('/User-Account/destroy/{id}',[CrudUserController::class,'destroy']);

    //Crud Master Data Konservasi
    Route::get('/konservasi-data',[MasterController::class,'index']);
    Route::post('/konservasi-data/store',[MasterController::class,'store']);
    Route::get('/konservasi-data/filter',[MasterController::class,'filter']);
    Route::post('/konservasi-data/update/{id}',[MasterController::class,'update']);
    Route::get('/konservasi-data/destroy/{id}',[MasterController::class,'destroy']);
});                                                                                                                 
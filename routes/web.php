<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\User;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
    return view('dashboard');
});

//Set Localization 

Route::get('/lang/{lang}',[UserController::class,'setLocal'])->name('lang');

Route::get('/home', [HomeController::class,'index'])->name('home');

Route::group(['prefix' => 'user'],function(){
    Route::get('/',[UserController::class,'index']);
    Route::get('/edit',[UserController::class,'index']);
    Route::post('/upsert',[UserController::class,'upsert']);
});

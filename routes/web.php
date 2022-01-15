<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
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
Route::get('/test',function(){
    $user = User::find(1);
    Password::createToken($user);
});

Route::group(['middleware' => 'auth'],function(){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    
    //Set Localization 
    Route::get('/lang/{lang}',[UserController::class,'setLocal'])->name('lang');
    
    Route::group(['prefix' => 'user'],function(){
        Route::get('/',[UserController::class,'index']);
        Route::get('/edit/{user}',[UserController::class,'edit']);
        Route::post('/upsert/{user?}',[UserController::class,'upsert']);
        Route::get('/list',[UserController::class,'filter']);
    });
});

Route::get('/test',function(){
    // $request = [
    //     'name' => 'Abdelrhman',
    //     'type' => 1,
    //     'active' => 1
    // ];
    // dd(User::filter($request)->toArray());
    $jobs = [1,2,3];
    dd(Arr::random($jobs,1));
});

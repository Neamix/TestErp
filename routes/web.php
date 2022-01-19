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

        if(Auth::user()->hasPriviledge(SYSTEM_ADMIN)) {
            return view('dashboard');
        } else {
            return redirect()->route('user.profile');
        }

    })->name('dashboard');
    
    //Set Localization 
    Route::get('/lang/{lang}',[UserController::class,'setLocal'])->name('lang');
    
    Route::group(['prefix' => 'user'],function(){
        Route::get('/',[UserController::class,'index'])->name('user.index');
        Route::get('/edit/{user}',[UserController::class,'edit'])->name('user.edit');
        Route::post('/upsert/{user?}',[UserController::class,'upsert'])->name('user.upsert');
        Route::get('/list',[UserController::class,'filter'])->name('user.filter');
        Route::get('/profile',[UserController::class,'profile'])->name('user.myprofile');
        Route::get('/profile/{user}',[UserController::class,'profile'])->name('user.profile');
        Route::post('/avatar',[UserController::class,'avatar'])->name('user.avatar');
        Route::post('/priviledge/{user}',[UserController::class,'priviledges'])->name('user.priviledge');
    });
});

Route::get('/test',function(){
    // $request = [
    //     'name' => 'Abdelrhman',
    //     'type' => 1,
    //     'active' => 1
    // ];
    // dd(User::filter($request)->toArray());
    // $jobs = [1,2,3];
    // dd(Arr::random($jobs,1));
});

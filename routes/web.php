<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Policies\UserPolicy;
use App\Student;
use App\Teacher;
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
            return redirect()->route('user.myprofile');
        }

    })->name('dashboard');
    
    //Set Localization 
    Route::get('/lang/{lang}',[UserController::class,'setLocal'])->name('lang');

    //trash bin
    Route::get('/trash/{model}',function(){
        return view('trash')->with('users',User::onlyTrashed()->get());
    })->name('trash');
    
    Route::group(['prefix' => 'user'],function(){
        Route::get('/',[UserController::class,'index'])->name('user.index');
        Route::get('/edit/{user}',[UserController::class,'edit'])->name('user.edit');
        Route::post('/upsert/{user?}',[UserController::class,'upsert'])->name('user.upsert');
        Route::get('/list',[UserController::class,'filter'])->name('user.filter');
        Route::get('/profile',[UserController::class,'profile'])->name('user.myprofile');
        Route::get('/profile/{user}',[UserController::class,'profile'])->name('user.profile');
        Route::post('/avatar',[UserController::class,'avatar'])->name('user.avatar');
        Route::post('/priviledge/{user}',[UserController::class,'priviledges'])->name('user.priviledge');
        Route::post('/state/{user}',[UserController::class,'toggleActive'])->name('user.state');
        Route::post('/delete/{user}',[UserController::class,'destroy'])->middleware(['checkPassword','checkAuthority'])->name('user.destroy');
        Route::post('/forcedelete/{user}',[UserController::class,'forceDelete'])->middleware(['checkPassword','checkAuthority'])->name('user.force');
        Route::post('/softdelete/{user}',[UserController::class,'delete'])->middleware(['checkPassword','checkAuthority'])->name('user.soft');
        Route::post('/restore/{user}',[UserController::class,'restore'])->middleware(['checkPassword','checkAuthority'])->name('user.restore');
    });
});

Route::get('/test',function(){
   dd( Student::all()->toArray() );
});

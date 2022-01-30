<?php

use App\Course;
use App\Crew;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\UserController;
use App\Policies\UserPolicy;
use App\Student;
use App\Teacher;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Request;
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
            return view('dashboard')->with([
                'crew'    => Crew::all()->count(),
                'courses' => Course::all()->count(),
                'teacher' => Teacher::all()->count(),
                'student' => Student::all()->count(),
            ]);
        } else {
            return redirect()->route('user.myprofile');
        }

    })->name('dashboard');
    
    //Set Localization 
    Route::get('/lang/{lang}',[UserController::class,'setLocal'])->name('lang');

    //trash bin
    Route::get('/trash/{model}',[TrashController::class,'index'])->name('trash');
    
    Route::group(['prefix' => 'user'],function(){
        Route::get('/',[UserController::class,'index'])->name('user.index');
        Route::get('/edit/{user}',[UserController::class,'edit'])->name('user.edit');
        Route::post('/upsert/{user?}',[UserController::class,'upsert'])->name('user.upsert');
        Route::get('/list',[UserController::class,'list'])->name('user.list');
        Route::get('/filter',[UserController::class,'filter'])->name('user.filter');
        Route::get('/profile',[UserController::class,'profile'])->name('user.myprofile');
        Route::get('/profile/{user}',[UserController::class,'profile'])->name('user.profile');
        Route::post('/avatar',[UserController::class,'avatar'])->name('user.avatar');
        Route::post('/priviledge/{user}',[UserController::class,'priviledges'])->name('user.priviledge');
        Route::post('/state/{user}',[UserController::class,'toggleActive'])->name('user.state');
        Route::post('/delete/{user}',[UserController::class,'destroy'])->middleware(['checkPassword','checkAuthority'])->name('user.destroy');
        Route::post('/forcedelete/{user}',[UserController::class,'forceDelete'])->middleware(['checkPassword','checkAuthority'])->name('user.force');
        Route::post('/softdelete/{user}',[UserController::class,'delete'])->middleware(['checkPassword','checkAuthority'])->name('user.soft');
        Route::post('/restore/{user}',[UserController::class,'restore'])->middleware(['checkPassword','checkAuthority'])->name('user.restore');
        Route::post('/admin/{user}',[UserController::class,'toggleAdmin'])->middleware(['checkPassword','checkAuthority'])->name('user.admin');
    });

    Route::group(['prefix' => 'subject'],function(){
        Route::get('/',[CourseController::class,'index'])->name('course.index');
        Route::get('/edit/{course}',[CourseController::class,'edit'])->name('course.edit');
        Route::post('/upsert/{course?}',[CourseController::class,'upsert'])->name('course.upsert');
        Route::get('/list',[CourseController::class,'filter'])->name('course.list');
        Route::get('/scedule',[CourseController::class,'schedule'])->name('course.schedule');
        Route::post('/destroy/{course}',[CourseController::class,'destroy'])->name('course.destroy');
        Route::post('/delete/{course}',[CourseController::class,'delete'])->name('course.soft');
        Route::post('/restore/{course}',[CourseController::class,'restore'])->name('course.restore');
        Route::get('/profile/{course}',[CourseController::class,'profile'])->name('course.profile');
    });
    
});

Route::get('/test',function(){
    return view('emails.verifyEmail')->with('data',['email'=>'abdalrhmanhussin44@gmail.com','token'=> 'adsasdasdasd','type'=>'teacher','title'=>'Verify','name'=>'Abdalrhman']);
});

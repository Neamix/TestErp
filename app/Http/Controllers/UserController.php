<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function setLocal($local) {
       Auth::user()->setLocal($local);
       return redirect()->back();
    }

    public function upsert(User $user) {
       $upsertInstance = $user->upsert();
       return $upsertInstance;
    }
}

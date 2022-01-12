<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
   public function setLocal($local) {
      Auth::user()->setLocal($local);
      return redirect()->back();
   }

   public function index() {
      return view('user.upsert');
   }

   public function upsert(UserRequest $request) {
      $upsertInstance = User::upsertInstance($request->all());
      return $upsertInstance;
   }
}

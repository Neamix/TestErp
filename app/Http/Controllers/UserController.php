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
      $user = (isset($request->id)) ? User::find($request->id): new User($request->all());
      $upsertInstance = $user->upsertInstance($request);
      return $upsertInstance;
   }

   public function edit(User $user) {
      return view('user.upsert')->with([
         'user' => $user
      ]);
   }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriviledgeRequest;
use App\Http\Requests\UserAvatar;
use App\Http\Requests\UserRequest;
use App\Priviledge;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\validationTrait;

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

   public function list() {
      return view('user.list');
   }

   public function filter(Request $request) {
      $users = User::filter($request->all())->paginate(15);

      if( $request->ajax() ) {
         return $users;
      }


      return view('user.list')->with([
         'users' => $users
      ]);
   }

   public function edit(User $user) {
      return view('user.upsert')->with([
         'user' => $user
      ]);
   }

   public function avatar(UserAvatar $request) {
      return auth()->user()->avatarModify($request->avatar);
   }

   static public function profile(User $user ) {
      $user = (isset($user->id)) ? $user : Auth::user();
      return view('user.profile')->with([
         'user' => $user,
         'priviledges' => Priviledge::all()
      ]);
   }

   public function priviledges(PriviledgeRequest $priviledges,User $user) {
      return $user->modifyPriviledges($priviledges->priviledges);
   }

   public function toggleActive(User $user) {
      return $user->toggleActive();
   }

   public function destroy(User $user) {
      $user->forceDelete();
      return redirect()->route('user.filter');
   }

   public function forceDelete($user) {
      User::onlyTrashed()->where('id',$user)->forceDelete();
   }

   public function delete(User $user) {
      $user->delete();
      return 'deleted';
   }

   public function restore($user) {
      User::onlyTrashed()->where('id',$user)->restore();
      return self::validationTrait('success','User has been restored');
   }
}

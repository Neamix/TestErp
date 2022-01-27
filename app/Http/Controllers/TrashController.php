<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index(Request $request) {
        if($request->model == 'user') {
            return view('user.trash')->with('users',User::onlyTrashed()->get());
        } else if($request->model == 'course') {
            return view('courses.trash')->with('courses',Course::onlyTrashed()->get());
        } else {
            return abort(404);
        }
    }
}

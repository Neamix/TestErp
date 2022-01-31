<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\CourseRequest;
use App\Teacher;
use App\Traits\validationTrait;
use App\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index() {
        return view('courses.upsert')->with(['teachers' => Teacher::all()]);
    }

    public function upsert(CourseRequest $request) {
        $course = (isset($request->id)) ? Course::find($request->id): new Course($request->all());
        $upsertInstance = $course->upsertInstance($request);
        return  $upsertInstance;
    }

    public function edit(Course $course) {
        return view('courses.upsert')->with([
            'course' => $course
        ]);
    }

    public function filter(Request $request) {
        $courses = Course::filter($request)->paginate($request['limit'] ?? 15);

        if($request->ajax()) {
            return $courses;
        }

        return view('courses.list')->with([
            'courses' => $courses,
            'teachers' => Teacher::all()
        ]);

    }

    public function schedule() {
        return view('courses.schedule')->with('courses',Course::getSchedule());
    }

    public function profile(Course $course) {
        return view('courses.profile')->with('course',$course);
    }

    public function delete(Course $course) {
        $course->delete();
        return User::validationResult('success','');
    }

    public function restore($course) {
        Course::onlyTrashed()->where('id',$course)->restore();
        return User::validationResult('success','');
    }

    public function destroy($course) {
        Course::withTrashed()->where('id',$course)->forceDelete();
        return User::validationResult('success','');
    }
}

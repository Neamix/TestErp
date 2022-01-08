<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use App\traits\upsertInstance;
use Carbon\Carbon;

class StudentController extends Controller
{
    use upsertInstance;

    protected $table = 'users';
    protected $guard = [];
    
    public function createInstance()
    {
        $this->save();

        return self::updateInstance($this);
    }

    static function updateInstance($data) {
        $user = self::firstOrCreate(
            ['id' => $data->id],
            [
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password),
                'avatar' => 'images/users/default.png',
                'age' => $data->age,
                'join_date' => Carbon::now(),
                'grade' => $data->grade,
                'type' => 'Student'
            ]
        );

        return $user;
    }

    public function teacher() {
        return $this->belongsToMany(Teacher::class,'teacher_student');
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }

}

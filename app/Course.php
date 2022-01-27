<?php

namespace App;

use App\Traits\upsertTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Validation\ValidatesRequests;

class Course extends Model
{
    use ValidatesRequests,upsertTrait,SoftDeletes;

    protected $guarded = [];
    protected $with = ['teachers','students'];

    public function createInstance() {
        $subject = self::create([]);
        return $subject->updateInstance($this->toArray());
    }

    public function updateInstance($data) {
        
        $subject = self::updateOrCreate(
            ['id' => $this->id ?? null],
            [
                'name' => $data['name'],
                'day'  => $data['day'],
                'start_at' => $data['start'],
                'end_at'  => $data['end']
            ]
        );

        $this->teachers()->sync($data['teachers']);
        $this->students()->sync($data['students']);
    }

    static function filter($request) {

        $builder = Course::select('*');

        if(! empty($request['name'])) {
            $builder->where('name','like','%'.$request['name'].'%');
        }


        if(! empty($request['teacher'])) {
            //note join will disable the relation loaded by with
            $builder->whereIn('courses.id',function($query) use ($request) {
                $query->from('course_teacher')
                      ->where('teacher_id',$request['teacher'])
                      ->select('course_id');
            });
        }

        return $builder->with('teachers');

    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class,'course_teacher')->withTimestamps();
    }

    public function students() {
        return $this->belongsToMany(Student::class,'course_student')->withTimestamps();
    }

    static function getSchedule() {
        return Course::all()->groupBy('day')->all();
    }
}

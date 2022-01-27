<?php

namespace App\Http\Requests;

use App\Course;
use App\Teacher;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'teachers' => ['required','interference' =>
                function ($attribute,$value,$fail) {
                        
                    $args = $this;

                    $getTeachersHaveInterferenceName = Teacher::whereIn('users.id',$args->teachers)->whereHas('courses',function($course) use ($args) {

                        $course->where(function($query) use ($args){
                            $query->whereBetween('start_at',[$args->start,$args->end]);
                            $query->orWhereBetween('end_at',[$args->start,$args->end]);
                        })->where('day',$args->day);

                        if($args->id) {
                            $course->where('courses.id','<>',$args->id);
                        }

                    })->pluck('name')->toArray();

                    if($getTeachersHaveInterferenceName) {
                        $implodeTeachers = implode(',',$getTeachersHaveInterferenceName);
                        return $fail(__('validation.schedule_interferance_with_the_following_teachers',['teachers' => $implodeTeachers]));
                    }
                }
            ],
            'students' => 'required',
            'end' => ['required',
                function ($attribute,$value,$fail) {
                    if( $this->start >= $this->end ) {
                        return $fail('validation.invalid');
                    }
                }],
            'day' => 'required',
            'start' => ['required']
        ];
    }
}

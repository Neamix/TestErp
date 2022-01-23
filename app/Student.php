<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'users';

    protected static function booted() {
        static::addGlobalScope('students', function (Builder $builder) {
            $builder->where('type', STUDENT);
        });
    }

    public function Courses() {
        return $this->hasMany(Course::class);
    }
}

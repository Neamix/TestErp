<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'users';

    protected static function booted() {
        static::addGlobalScope(function (Builder $builder) {
            $builder->where('type', TEACHER);
        });
    }

    public function Courses() {
        return $this->hasMany(Course::class);
    }
}

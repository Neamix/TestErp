<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'users';

    protected static function booted() {
        static::addGlobalScope('teachers', function (Builder $builder) {
            $builder->where('type', TEACHER);
        });
    }
}

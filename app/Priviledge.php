<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priviledge extends Model
{
    protected $guarded = [];

    public function users() {
        return $this->belongsToMany(User::class,'user_priviledge');
    }
}

<?php 

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

trait generateToken {
    static public function token($user) {
       $token =  Password::createToken($user);;
       return $token; 
    }
}
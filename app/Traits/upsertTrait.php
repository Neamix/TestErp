<?php 

namespace App\Traits;

use App\User;

trait upsertTrait {
    
    public static function upsertInstance($user) {
        $user = new User($user);
        return ( isset($user->id) ) ? $user->createInstance() : $user->updateInstance();
    }

}

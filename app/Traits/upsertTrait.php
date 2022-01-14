<?php 

namespace App\Traits;

use App\User;

trait upsertTrait {
    
    public  function upsertInstance($request) {
        return ( isset($this->id) ) ? $this->updateInstance($request->all()) : $this->createInstance();
    }

}

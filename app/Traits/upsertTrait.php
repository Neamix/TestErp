<?php 

namespace App\Traits;


class upsertInstance {
    
    public function upsertInstance() {
        ( isset($this->id) ) ? $this->createInstance() : self::updateInstance($this);
    }

}

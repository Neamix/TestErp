<?php 

namespace App\Traits;


trait upsertTrait {
    
    public function upsertInstance() {
        ( isset($this->id) ) ? $this->createInstance() : $this->updateInstance();
    }

}

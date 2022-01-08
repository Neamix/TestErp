<?php 

namespace App\Http\Controllers;


class upsert {
    
    public function upsertInstance() {
        ( isset($this->id) ) ? $this->createInstance() : $this->updateInstance();
    }

}

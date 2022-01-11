<?php 

namespace App\Traits;

trait validationTrait {

    public function validationResult($result,$message) {
        return [
            'result' => $result,
            'message' => $message
        ];
    }

}
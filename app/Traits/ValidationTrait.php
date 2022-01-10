<?php 

namespace App\Traits;

class validationTrait {

    public function validationResult($result,$message) {
        return [
            'result' => $result,
            'message' => $message
        ];
    }

}
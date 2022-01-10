<?php 

namespace App\Traits;

class ValidationTrait {

    public function validationResult($result,$message) {
        return [
            'result' => $result,
            'message' => $message
        ];
    }

}
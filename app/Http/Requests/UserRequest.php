<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required','email','unique:users.email'],
            'name'  => ['required'],
            'password' => ['required','min:8'],
            'type'   => ['required'],
            'join_date' => [
                function($attribute, $value, $fail) {
                    if($data > Carbon::now()) {
                        $fail(__('you_can\'t_add_user_in_a_future_date'));
                    }
                }
            ]
        ];
    }
}

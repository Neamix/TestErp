<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rule;
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
            'email' => [Rule::requiredIf( ! $this->id ),'email','unique:users'],
            'name'  => [Rule::requiredIf( ! $this->id )],
            'password' => [Rule::requiredIf( ! $this->id ),'min:8'],
            'type'   => [Rule::requiredIf( ! $this->id )],
            'join_date' => [
                function($attribute, $value, $fail) {
                    if(strtotime($value) > strtotime(Carbon::now())) {
                        return $fail(__('system.you_can\'t_add_user_in_a_future_date'));
                    }
                }
            ]
        ];
    }
}

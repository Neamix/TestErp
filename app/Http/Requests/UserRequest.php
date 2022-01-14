<?php

namespace App\Http\Requests;

use App\User;
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
            'email' => ['required','email',function($attribute,$value,$fail){
                if(isset($this->id)) {
                    $userWithEmail = User::where('email',$this->email)->where('id','<>',$this->id)->count();
                } else {
                    $userWithEmail = User::where('email',$this->email)->count();
                }
                if($userWithEmail) {
                    $fail('validation.unique');
                }
            }],
            'name'  => ['required'],
            'type'   => ['required'],
            'join_date' => [
                function($attribute, $value, $fail) {
                    if(strtotime($value) > strtotime(Carbon::now())) {
                        return $fail(__('
                        .you_can\'t_add_user_in_a_future_date'));
                    }
                }
            ]
        ];
    }
}

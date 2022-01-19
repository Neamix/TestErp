<?php

namespace App\Http\Requests;

use App\Priviledge;
use Illuminate\Foundation\Http\FormRequest;

class PriviledgeRequest extends FormRequest
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
            'priviledges' => ['required',function($attribute,$value,$fail) {
                Priviledge::whereIn('id',$this->priviledges)->each(function($priviledge) use ($fail) {
                    if($priviledge->parent_id) {

                        if( ! in_array($priviledge->parent_id,$this->priviledges) ) {
                            $fail('validation.parent_missing');
                        }

                    }
                });
            }]
        ];
    }
}

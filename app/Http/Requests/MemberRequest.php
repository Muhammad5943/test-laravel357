<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends ReqValidator
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
        $rules = [
            'group_id' => 'integer',
            'nama' => 'string',
            'email' => 'string',
            'alamat' => 'string',
            'hp' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'profile_pic' => 'image|mimes:png,jpg,jpeg',
        ];

        if($this->getMethod() == 'POST'){
            $rules = $this->addRequired($rules);
        }



        return [
            //
        ];
    }
}

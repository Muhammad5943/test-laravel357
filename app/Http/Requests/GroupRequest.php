<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends ReqValidator
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
            'namagroup' => 'string|min:2|max:30',
            'kota' => 'string|max:30'
        ];

        if($this->getMethod() == 'POST'){
            $rules = $this->addRequired($rules);
        }


        return $rules;
    }
}

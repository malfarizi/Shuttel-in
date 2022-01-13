<?php

namespace App\Http\Requests;

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
        $rules = [
            'name'          => 'required',
            'phone_number'  => 'required|numeric|digits_between:10,15',
            'address'       => 'required'
        ];

        if($this->getMethod() == 'POST'){
            $rules += [
                'email'     => 'required|unique:users', 
                'password'  => 'required|confirmed|min:8'
            ];
        }

        return $rules;
    }

    protected function store()
    {
        return [
            'email'     => 'required|unique:users',
            'password'  => 'required|confirmed|min:8',
        ];
    }
}

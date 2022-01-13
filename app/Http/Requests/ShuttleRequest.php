<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShuttleRequest extends FormRequest
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
            'nopol'             => 'required|max:10',
            'shuttle_status'    => 'required|in:Aktif,Tidak Aktif',
            'driver_id'         => 'required|exists:App\Models\Driver,id'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([ 
            'shuttle_status' => $this->shuttle_status ? 'Aktif' : 'Tidak Aktif' 
        ]);
    }
}

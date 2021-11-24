<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'date_of_depature' => 'required|date|after:today', 
            'depature_time'    => 'required|date_format:H:i',
            'schedule_status'  => 'required|in:Aktif,Tidak Aktif', 
            'route_id'         => 'required|exists:App\Models\Route,id'
        ];
    }


    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    /* public function messages()
    {
        return [];
    } */
}

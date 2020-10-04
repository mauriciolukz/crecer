<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class registro extends FormRequest
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
            'nombre'=>'string|required|max:255',
            'apepaterno'=>'string|required|max:255',
            'apematerno'=>'string|required|max:255',
            'telefono'=>'required|digits:10',
            'email'=>'email|required|unique:users|max:255',
            'password' => 'required|string|min:6'
        ];
    }
}

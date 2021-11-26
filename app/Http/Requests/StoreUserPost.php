<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
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
     * Regla de valiadacion crada para que un usuario inserte otro usuario
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|string|max:255|min:4',
            'email' => 'required|string|max:255|unique:users',
            'password'=> 'required|min:8|string|confirmed'
        ];
    }
}

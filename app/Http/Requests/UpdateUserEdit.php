<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserEdit extends FormRequest
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
     * Regla de valiacion creada para modificar un registro por otro usuario
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|string|max:255|min:4',
            'email' => 'required|string|max:255|unique:users,email,'.$this->route('user')->id,
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,' . ($this->usuario->id ?? '') . ',id',
            'password' => 'required_without:id',
            'file' => 'image|mimes:jpeg,bmp,jpg,png,gif|max:3072',
            'rol' => 'integer',
            'last_name' => 'string|max:191',
            'address' => 'nullable|string|max:191',
            'interior_number' => 'nullable|string|max:191',
            'exterior_number' => 'nullable|string|max:191',
            'suburb' => 'nullable|string|max:191',
            'between_streets' => 'nullable|string|max:191',
            'postal_code' => 'nullable|string|max:5',
            'phone' => 'nullable|string|max:191',
            'cellphone' => 'nullable|string|max:191',
            'city_id' => 'nullable|integer',
            'state_id' => 'nullable|integer',
        ];
    }

    
}

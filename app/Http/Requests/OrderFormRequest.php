<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
            'street' => 'required|string|max:191',
            'num_int' => 'nullable|string|max:191',
            'num_ext' => 'nullable|string|max:191',
            'neighborhood' => 'nullable|string|max:191',
            'between_streets' => 'nullable|string|max:191',
            'postal_code' => 'nullable|string|max:5',
            'city_id' => 'nullable|integer',
            'state_id' => 'nullable|integer',
        ];
    }

     public function messages()
    {
        return [
            
            'street.required' => 'Debe introducir la calle',
            'street.string' => 'El nombre de la calle debe ser un string',
            
        ];
    }
}

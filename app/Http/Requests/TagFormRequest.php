<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagFormRequest extends FormRequest
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
            'name' => 'required|string|max:191|unique:tags,name,'.($this->tag->id ?? '').",id",
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El tag debe tener un nombre',
            'name.string' => 'El nombre del tag debe ser un string',
            'name.unique' => 'Ese nombre ya fue tomado'
        ];
    }
}

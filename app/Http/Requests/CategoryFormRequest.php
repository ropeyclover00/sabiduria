<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryFormRequest extends FormRequest
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
            'name' => 'required|string|max:191|unique:categories,name,'.($this->categorium->id ?? '').",id",
            'file' => 'image|mimes:jpeg,bmp,jpg,png,gif|max:3072',
            'description' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'file.image' => "Debe subir una imagen al servidor",
            'file.mimes' => 'Solo se permite subir imagenes con extension jpeg, bmp, png, jpg o gif',
            'file.max' => 'Solo se permite subir imagenes con un peso maximo de 2MB',
            'name.required' => 'La categoria debe tener un nombre',
            'name.string' => 'El nombre de la categoria debe ser un string',
            'name.unique' => "Ese nombre ya fue tomado"
        ];
    }
}

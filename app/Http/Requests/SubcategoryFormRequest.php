<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryFormRequest extends FormRequest
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
                'file' => 'image|mimes:jpeg,bmp,jpg,png,gif|max:3072',
                'description' => 'nullable|string',
                'category_id' => 'required|integer'
            
        ];
    }

    public function messages()
    {
        return [
            'file.image' => "De subir una imagen al servidor",
            'file.mimes' => 'Solo se permite subir imagenes con extension jpeg, bmp, png, jpg o gif',
            'file.max' => 'Solo se permite subir imagenes con un peso maximo de 2MB',
            'name.required' => 'La categoria debe tener un nombre',
            'name.string' => 'El nombre de la categoria debe ser un string',
            'category_id.required' => "Necesita seleccionar la categoria a la cual pertenece",
            'category_id.integer' => "Necesita seleccionar la categoria a la cual pertenece"
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditorialFormRequest extends FormRequest
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
            'address' => 'required|string',
            'phone' => 'required|string|max:191',
            'email' => 'nullable|email',
            'url' => 'nullable|url',
            'country_id' => 'required|integer',
            'file' => 'image|mimes:jpeg,bmp,jpg,png,gif|max:3072',
        ];
    }


    public function messages()
    {
        return [
            'file.image' => "Debe subir una imagen al servidor",
            'file.mimes' => 'Solo se permite subir imagenes con extension jpeg, bmp, png, jpg o gif',
            'file.max' => 'Solo se permite subir imagenes con un peso maximo de 2MB',
            'name.required' => 'La editorial debe tener un nombre',
            'name.string' => 'El nombre de la editorial debe ser un string',
            'address.required' => 'La direccion de la editorial es requerida',
            'phone.required' => 'El teléfono de la editorial es requerido',
            'country_id.required' => 'Debe seleccionar el pais de la editorial',
            'country_id.integer' => 'Debe seleccionar el pais de la editorial',
            'email.email' => "Debe introducir un email válido",
            'url.url' => "Debe introducir una URL válida"

        ];
    }

}

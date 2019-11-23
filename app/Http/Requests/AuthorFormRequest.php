<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorFormRequest extends FormRequest
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
            'last_name' => 'required|string|max:191',
            'birthday' => 'required|date',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'country_id' => 'required|integer',
            'file' => 'image|mimes:jpeg,bmp,jpg,png,gif|max:3072',
        ];
    }

    public function messages()
    {
        return [
            'file.image' => "De subir una imagen al servidor",
            'file.mimes' => 'Solo se permite subir imagenes con extension jpeg, bmp, png, jpg o gif',
            'file.max' => 'Solo se permite subir imagenes con un peso maximo de 2MB',
            'name.required' => 'El autor debe tener un nombre',
            'name.string' => 'El nombre del autor debe ser un string',
            'last_name.required' => 'Debe introducir los apellidos del autor',
            'last_name.string' => 'Los apellidos del autor deben ser un string',
            'birthday.required' => 'Debe introducir la fecha de nacimiento del autor',
            'birthday.date' => 'Debe introducir la fecha en el formato mm-dd-yyyy',
            'email.email' => "Debe introducir un email válido",
            'address.string' => "Debe introducir la dirección",
            'country_id.required' => 'Debe seleccionar el país del autor',
            'country_id.integer' => 'Debe seleccionar el país del autor',
        ];
    }
}

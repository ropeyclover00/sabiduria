<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogFormRequest extends FormRequest
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
            'name' => 'required|string|max:191|unique:blogs,name,'.($this->blog->id ?? '').",id",
            'content' => 'required|string',
            'status' => 'integer',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'file' => 'image|mimes:jpeg,bmp,jpg,png,gif|max:3072',
        ];
    }

    public function messages()
    {
        return [
            'file.image' => "Debe subir una imagen al servidor",
            'file.mimes' => 'Solo se permite subir imagenes con extension jpeg, bmp, png, jpg o gif',
            'file.max' => 'Solo se permite subir imagenes con un peso maximo de 2MB',
            'name.required' => 'El blog debe tener un nombre',
            'name.string' => 'El nombre del blog debe ser un string',
            'content.required' => 'No ha llenado el blog',
            'content.string' => 'El contenido del blog debe ser un string',
            'user_id.required' => 'El Blog debe pertenecer a un autor',
            'user_id.integer' => 'Debe seleccionar a un autor',
            'category_id.required' => 'El Blog debe pertenecer a una categoria',
            'category_id.integer' => 'Debe seleccionar una categoria',
            'subcategory_id.required' => 'El Blog debe pertenecer a una subcategoria',
            'subcategory_id.integer' => 'Debe seleccionar una subcategoria',
            'status.integer' => 'Debe seleccionar el estatus del blog!',
            'name.unique' => 'Ese nombre ya fue tomado'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'name' => 'required|string|max:191|unique:products,name,'.($this->producto->id ?? '').",id",
            'description' => 'required|string',
            'isbn' => 'required|string|max:191',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'stock' => 'integer',
            'status' => 'integer',
            'outstanding' => 'integer',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'country_id' => 'required|integer',
            'file' => 'image|mimes:jpeg,bmp,jpg,png,gif|max:3072'

        ];
    }

     public function messages()
    {
        return [
            'isbn.required' => 'Debe introducir el ISBN',
            'year.required' => 'Debe introducir el año en este formato: 2019]',
            'year.integer' => 'Debe introducir el año en este formato: 2019]',
            'price.required' => 'Debe introducir el precio numerico del producto',
            'price.numeric' => 'Debe introducir el precio numerico del producto',
            'stock' => 'Cantidad no válida para el stock',
            'file.image' => "Debe subir una imagen al servidor",
            'file.mimes' => 'Solo se permite subir imagenes con extension jpeg, bmp, png, jpg o gif',
            'file.max' => 'Solo se permite subir imagenes con un peso maximo de 2MB',
            'name.required' => 'El producto debe tener un nombre',
            'name.string' => 'El nombre del producto debe ser un string',
            'description.required' => 'No ha llenado la descripción producto',
            'description.string' => 'La descripción del producto debe ser un string',
            'country_id.required' => 'El producto debe pertenecer a un país',
            'country_id.integer' => 'Debe seleccionar a un país',
            'category_id.required' => 'El producto debe pertenecer a una categoria',
            'category_id.integer' => 'Debe seleccionar una categoria',
            'subcategory_id.required' => 'El producto debe pertenecer a una subcategoria',
            'subcategory_id.integer' => 'Debe seleccionar una subcategoria',
            'status.integer' => 'Debe seleccionar el estatus del producto!',
            'name.unique' => 'Ese nombre ya fue tomado'
        ];
    }
}

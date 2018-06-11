<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartAddItem extends FormRequest
{
    
    public function authorize()
    {
        return $this->user()->role->name === "tienda";
    }


    public function rules()
    {
        return [
            'quantity' => 'required|integer|min:1',
            'details' => 'sometimes|required|min:3',
        ];
    }

    public function messages() {
        return [
            'quantity' => 'La cantidad debe ser un número entero mayor que 0',
            'details' => 'Los detalles deben contener un mínimo de 3 carácteres'
        ];
    }
}

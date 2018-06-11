<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCart extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->user()->role->name === "tienda") || ($this->user()->role->name === "admin");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => 'required|integer|min:1',
            'products' => 'required|min:1',
            'products.quantity' => 'required|integer|min:1',
            'products.details' => 'sometimes|required|min:5',
        ];
    }
}

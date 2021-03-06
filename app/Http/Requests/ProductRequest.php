<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
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
            'img'         => 'required|image',
            'name'        => 'required|min:3|max:255',
            'description' => 'max:4048',
            'price'       => 'required|numeric|between:0,9999999.99'
        ];
    }
}

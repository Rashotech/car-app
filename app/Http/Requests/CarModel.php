<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarModel extends FormRequest
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
            'name' => 'bail|required|string|unique:car_models,model_name',
            'date' => 'required',
            'engine' => 'required',
            'image_path' => 'required|mimes:jpg,png,jpeg|max:5048'
        ];
    }
}

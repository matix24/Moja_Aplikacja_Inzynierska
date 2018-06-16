<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackagingProductRequest extends FormRequest
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
            'name' => 'required|max:190'
        ];
    }// end rules

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
          'name.required' => 'Nazwa jest wymagana.',
          'name.max' => 'Maksymalna ilość znaków to 190.'
        ];
    }// end messages

}// end class PackagingProductRequest

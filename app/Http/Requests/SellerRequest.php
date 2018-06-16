<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
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
          'name' => 'required|max:190',
          'surname' => 'required|max:190',
          'address' => 'required|max:190',
          'phone_number' => 'required|regex:/^(?:\(?\+?48)?(?:[-\.\(\)\s]*(\d)){9}\)?$/'
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
          'name.required' => 'Imię jest wymagane.',
          'name.max' => 'Maksymalna ilość znaków to 190.',
          'surname.required' => 'Nazwisko jest wymagane.',
          'surname.max' => 'Maksymalna ilość znaków to 190.',
          'phone_number.required' => 'Numer telefonu jest wymagany.',
          'phone_number.regex' => 'Nieprawidłowy format numeru telefonu.',
          'address.required' => 'Adres jest wymagany.',
          'address.max' => 'Maksymalnie 190 znaków.'
        ];
    }// end messages

} // end class SellerRequest

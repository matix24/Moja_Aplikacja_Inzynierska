<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }// end authorize

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
          'email' => 'required|max:190|email',
          'phone_number' => 'required|regex:/^(?:\(?\+?48)?(?:[-\.\(\)\s]*(\d)){9}\)?$/',
          'address' => 'required|max:190'
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
          'email.required' => 'Email jest wymagany.',
          'email.max' => 'Maksymalna ilość znaków to 190.',
          'email.email' => 'Nieprawidłowy format email.',
          'phone_number.required' => 'Numer telefonu jest wymagany.',
          'phone_number.regex' => 'Nieprawidłowy format numeru telefonu.',
          'address.required' => 'Adres jest wymagany.',
          'address.max' => 'Maksymalnie 190 znaków.'
        ];
    }// end messages

}// end class

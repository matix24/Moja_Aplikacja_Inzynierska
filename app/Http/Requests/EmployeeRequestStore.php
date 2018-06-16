<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequestStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }// end authoorize

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
          'email' => 'required|max:190|email|unique:users',
          'phone_number' => 'required|regex:/^(?:\(?\+?48)?(?:[-\.\(\)\s]*(\d)){9}\)?$/',
          'password' => 'required|min:6|max:16',
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
          'email.unique' => 'Ten email już wystąpił w bazie danych.',
          'phone_number.required' => 'Numer telefonu jest wymagany.',
          'phone_number.regex' => 'Nieprawidłowy format numeru telefonu.',
          'password.required' => 'Hasło jest wymagane.',
          'password.min' => 'Minimun 6 znaków.',
          'password.max' => 'Maksymalnie 16 znaków.',
          'address.required' => 'Adres jest wymagany.',
          'address.max' => 'Maksymalnie 190 znaków.'
        ];
    }// end messages

}// end class

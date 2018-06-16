<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckRequest extends FormRequest
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
          'truck_id_number' => 'required|max:15',
          'capacity' => 'required|numeric|min:1',
          'capacity_palete' => 'required|numeric|min:1'
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
          'truck_id_number.required' => 'Numer rejestracyjny jest wymagany.',
          'truck_id_number.max' => 'Numer rejestracyjny ma maksymalnie 15 znaków.',
          'capacity.required' => 'Ładowność całkowita jest wymagana.',
          'capacity.numeric' => 'Ładowność całkowita musi być liczbą.',
          'capacity.min' => 'Ładowność całkowita jest większa niż 0.',
          'capacity_palete.required' => 'Ładowność pojedyńczej skrzyni jest wymagana.',
          'capacity_palete.numeric' => 'Ładowność pojedyńczej skrzyni jest liczbą.',
          'capacity_palete.min' => 'Ładowność pojedyńczej skrzyni jest większa niż 0.'
        ];
    }// end messages

}// end class TruckRequest

<?php namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUsuario extends FormRequest {

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
           'nombres' => array(
              'required',
              'max:30',
              'regex:/^[a-zA-ZáéíóúÁÉÍÓÚ0-9_. ]*$/'
            ),
           'email' => array(
              'required',
              'max:255',
              'regex:/^[^\s@]+@[^\s@]+\.[^\s@]+$/'
            ),
           'password' => array(
              'required',
              'max:255'
            )
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'nombres.required' => 'El nombres es obligatorio.',
            'nombres.max' => 'El campo nombres es como máximo 30 caracteres.',
            'nombres.regex' => 'El campo nombres solo permite caracteres alfanúmericos.',
            'email.required' => 'El correo electronico es obligatorio.',
            'email.max' => 'El campo correo electronico es como máximo 255 caracteres.',
            'email.regex' => 'El valor de este campo no es válido.',
            'password.required' => 'El password es obligatorio.',
            'password.max' => 'El campo password es como máximo 255 caracteres.',
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    public function formatErrors(Validator $validator)
    {
        return $validator->errors()->all();
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}

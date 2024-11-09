<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students',
            'phone' => 'required|digits:10',
            'language' => 'required|in:English,Spanish,French',
            'teacher_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'El campo :attribute es requerido.',
            'email' => 'El campo :attribute debe ser una dirección de correo válida.',
            'phone' => 'El campo :attribute debe tener 10 dígitos.',
            'language' => 'El campo :attribute debe ser uno de los siguientes: English, Spanish, French.',
            'teacher_id' => 'El campo :attribute debe coincidir con el lenguaje',
            'unique' => 'se esta ejecutando el error de unique'
        ];
    }
    
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'email' => 'correo electronico',
            'phone' => 'teléfono',
            'language' => 'idioma',
            'teacher_id' => 'id del profe'
        ];
    }
}

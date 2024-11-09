<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'email' => 'required|email|unique:teachers',
            'language' => 'required|in:English,Spanish,French'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'El campo :attribute es requerido.',
            'email' => 'El campo :attribute debe ser una dirección de correo válida.',
            'language' => 'El campo :attribute debe ser uno de los siguientes: English, Spanish, French.'
        ];
    }
    
    public function attributes()
    {
        return [
            'name' => 'nombre',
            'email' => 'correo electronico',
            'language' => 'idioma'
        ];
    }
}

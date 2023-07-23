<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgotFormRequest extends FormRequest
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
            'email' => 'required|email|string|exists:users',
        ];
    }

    public function messages()  //Описание ошибок для валидации
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'email' => 'Введите правильно email',
            'exists' => 'Пользователь с таким :attribute не найден',
            'string' => ':attribute должен быть строкой',
        ];
    }
}

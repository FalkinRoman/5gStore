<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BasketConfirmRequest extends FormRequest
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
        $isUserAuthenticated = auth()->check();

        $rules = [
            'name' => 'required|min:3|max:255',
            'phone' => [
                'required',
                'string',
                'regex:/^(\+7|8)?[\s(-]?9\d{2}[\s)-]?\d{3}[\s-]?\d{2}[\s-]?\d{2}$/'
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->id()) // Игнорируем текущего авторизованного пользователя
            ],
        ];

        if ($isUserAuthenticated) {
            // Если пользователь авторизован, удаляем правило 'unique' для поля 'email'
            unset($rules['email']);
        }

        return $rules;
    }


    public function messages()  //Описание ошибок для валидации
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'unique' => 'К сожалению :attribute уже занят',
            'email' => 'Введите правильно email',
            'regex' => 'Пример: +79998887766, 89998887766'
        ];
    }
}

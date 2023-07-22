<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|min:3|max:255',
            'phone' => 'required|min:11|numeric',
            'email' => 'required|email|unique:users'
        ];
    }


    public function messages()  //Описание ошибок для валидации
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'unique' => 'К сожалению :attribute уже занят',
            'email' => 'Введите правильно email',
        ];
    }
}

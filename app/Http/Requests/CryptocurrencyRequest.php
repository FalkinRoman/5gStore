<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CryptocurrencyRequest extends FormRequest
{
    /**
     * Определение, разрешено ли пользователю делать этот запрос.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Получение правил валидации, применяемых к запросу.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'symbol' => 'required|string|max:10',
            'name' => 'required|string|max:255',
        ];

        if ($this->route()->named('admin.cryptocurrencies.update')) {
            $cryptocurrencyId = $this->route()->parameter('cryptocurrency')->id;
            $rules['symbol'] .= ',symbol,' . $cryptocurrencyId;
        } else {
            $rules['symbol'] .= '|unique:cryptocurrencies';
        }

        return $rules;
    }

    public function messages()  //Описание ошибок для валидации
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'max' => 'Поле :attribute должно иметь минимум :max символов',
            'unique' => 'К сожалению :attribute уже занят',
            'string' => ':attribute должен быть строкой',
        ];
    }
}

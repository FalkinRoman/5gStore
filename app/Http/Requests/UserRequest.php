<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Если вы не хотите авторизацию для этого запроса, оставьте true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'email' => 'required|min:3|max:255|unique:users,email',
            'name' => 'required|min:3|max:255',
            'password' => 'required|min:6', // Добавьте правила для пароля, если это необходимо
        ];

//         Если это запрос на обновление существующего пользователя, добавьте правило исключения уникальности для текущего пользователя
        if ($this->route()->named('admin.users.update')) {
            $rules['email'] .= ',' . $this->route()->parameter('user')->id;
        }

        return $rules;
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'min' => 'Поле :attribute должно содержать минимум :min символов',
            'max' => 'Поле :attribute должно содержать максимум :max символов',
            'unique' => 'Такой :attribute уже существует',
        ];
    }
}

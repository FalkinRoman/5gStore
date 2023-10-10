<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
    public function rules()    //правила валидации для request
    {
        $rules = [
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|min:3|max:255',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'integer' => 'Поле :attribute должно быть целым числом',
            'min' => 'Поле :attribute должно содержать минимум :min символов',
            'max' => 'Поле :attribute должно содержать максимум :max символов',
            'exists' => 'Выбранный :attribute не существует',
            'rating.min' => 'Рейтинг должен быть от 1 до 5',
            'rating.max' => 'Рейтинг должен быть от 1 до 5',
        ];
    }
}

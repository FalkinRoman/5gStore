<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()  //если не хочу авторизацию в запрос добавляю true
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
            'code' => 'required|min:3|max:255|unique:subcategories,code',
            'name' => 'required|min:3|max:255',
        ];
        //добавляем уникальность только если роут будет named, this - FormRequest  внашем случае
        if ($this->route()->named('admin.subcategories.update')) {
            $rules['code'] .= ',' . $this->route()->parameter('subcategory')->id;
        }

        return $rules;
    }

    public function messages()  //Описание ошибок для валидации
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'code.min' => 'Поле код должно содержать не менее :min символов',
            'unique' => 'К сожалению :attribute уже занят',
        ];
    }
}

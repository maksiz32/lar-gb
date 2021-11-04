<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'nullable|integer|exists:orders,id',
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email:rfc,dns|regex:/^.+@.+$/i',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            'order' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attrubute обязательно для заполнения',
            'integer' => 'Значение :attribute может быть только числом',
            'exists' => 'Передано несуществующее значение :attribute',
            'string' => 'Значение :attribute может быть только строкой',
            'email' => 'Поле :attribute должно быть корректным email',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'имя',
            'email' => 'адрес электронной почты',
            'phone' => 'номер телефона',
            'order' => 'текст заказа',
        ];
    }
}

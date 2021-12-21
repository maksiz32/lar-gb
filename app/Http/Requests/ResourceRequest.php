<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
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
            'id' => 'nullable|integer|exists:resources,id',
            'title' => 'max:255',
            'path' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'integer' => 'Значение :attribute может быть только числом',
            'exists' => 'Передано несуществующее значение :attribute',
            'string' => 'Значение :attribute может быть только строкой',
            'max' => 'В поле :attribute должно быть не более :max символов',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'название/описание ресурса',
            'path' => 'адрес ресурса',
        ];
    }
}

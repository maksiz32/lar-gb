<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'id' => 'nullable|integer|exists:news,id',
            'title' => 'required|string|max:255',
            'textNews' => 'required|string',
            'author' => 'required|string|max:255',
            'categories' => 'nullable|integer|exists:categories,id',
            'sourceId' => 'nullable|integer|exists:sources,id',
            'sourceName' => 'required|string',
            'sourcePath' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Поле :attrubute обязательно для заполнения',
            'integer' => 'Значение :attribute может быть только числом',
            'exists' => 'Передано несуществующее значение :attribute',
            'string' => 'Значение :attribute может быть только строкой',
        ];
    }

    public function attributes(): array
    {
        return [
            'author' => 'автор',
            'title' => 'заголовок',
            'textNews' => 'поле добавления новости',
            'categories' => 'категории новостей',
            'sourceName' => 'имя/название ресурса',
            'sourcePath' => 'адрес ресурса',
        ];
    }
}

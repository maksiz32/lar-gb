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
            'id' => 'integer|exists:news,id',
            'title' => 'required|string',
            'textNews' => 'required|string',
            'author' => 'required|string',
            'categories' => 'integer|exists:categories,id',
            'sourceId' => 'integer|exists:sources,id|nullable',
            'sourceName' => 'required|string',
            'sourcePath' => 'required|string',
        ];
    }
}

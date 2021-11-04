<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'id' => 'nullable|integer|exists:feedbacks,id',
            'user_name' => 'required|string|max:255',
            'comment' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_name' => 'имя пользователя',
            'comment' => 'комментарий',
        ];
    }
}

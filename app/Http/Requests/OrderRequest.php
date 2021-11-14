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
            'id' => 'integer|exists:orders,id',
            'name' => 'required|string',
            'email' => 'required|email:rfc,dns|regex:/^.+@.+$/i',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'order' => 'required|string'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'author' => ['nullable','exists:authors,id'],
            'category' => ['nullable','exists:categories,id'],
            'title' => ['nullable','string','max:200']
        ];
    }
}

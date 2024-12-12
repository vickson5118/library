<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookFormValidation extends FormRequest
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
            'title' => ['required','min:3','max:200',Rule::unique('books')->ignore($this->book)],
            'publication' => ['nullable','date'],
            'summary' => ['required', 'min:20'],
            'page' => ['nullable','numeric'],
            'category' => ['required','exists:categories,id'],
            'language' => ['required','exists:languages,id'],
            'publishing' => ['required','exists:publishings,id'],
            'author' => ['array','required','exists:authors,id'],
            'cover' => ['image',Rule::requiredIf(fn() => $this->book == null)],
            'pdf' => ['nullable','file','mimes:pdf','max:50000'],
        ];
    }
}

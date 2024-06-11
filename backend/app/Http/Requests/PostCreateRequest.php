<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'content' => ['required', 'string', 'min:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Blog title is must',
            'title.min' => 'Title at-latest a three characters word',
            'content.required' => 'Blog must have content',
            'content.min' => 'Write content at-least long ten characters'

        ];

    }
}

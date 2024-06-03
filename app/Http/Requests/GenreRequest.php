<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
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
            'name' => 'required|unique:genres|max:255',
            'description' => 'required|max:255'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'name.unique'   => 'Genre already exists',
            'name.required' => 'Please enter a name',
            'name.max' => 'Please limit name to 255 characters',
            'description.required' => 'Please enter a description',
            'description.max' => 'Please limit description to 255 characters'
        ];
    }
}

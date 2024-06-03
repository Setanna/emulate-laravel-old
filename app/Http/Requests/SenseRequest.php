<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SenseRequest extends FormRequest
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
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'flavor' => 'required|max:65535',
            'system' => 'required|max:65535'
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
            'name.required' => 'Please enter a name',
            'name.max' => 'Please limit name to 255 characters',
            'description.required' => 'Please enter a description',
            'description.max' => 'Please limit description to 255 characters',
            'flavor.required' => 'Please enter a flavor text',
            'flavor.max' => 'Please limit flavor text to 65,535 characters',
            'system.required' => 'Please enter a system explanation',
            'system.max' => 'Please limit system text to 65,535 characters'
        ];
    }
}

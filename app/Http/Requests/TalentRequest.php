<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TalentRequest extends FormRequest
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
        if($this->method() == "PUT" && $this->talent){
            $name_rule = 'required|max:255|unique:talent,name,' . $this->talent->id;
        }else{
            $name_rule = 'required|max:255|unique:talent';
        }

        return [
            'name' => $name_rule,
            'experience_cost' => 'required|max:3|integer',
            'description' => 'required|max:255',
            'flavor' => 'required|max:65535',
            'system' => 'required|max:65535',
            'book_id' => 'required|max:20|integer|exists:books,id'
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
            'name.unique' => 'Name is taken',
            'description.required' => 'Please enter a description',
            'description.max' => 'Please limit description to 255 characters',
            'flavor.required' => 'Please enter a flavor text',
            'flavor.max' => 'Please limit flavor text to 65,535 characters',
            'system.required' => 'Please enter a system explanation',
            'system.max' => 'Please limit system text to 65,535 characters',
            'experience_cost.required' => 'Please enter an experience cost',
            'experience_cost.integer' => 'Please enter a number for experience cost',
            'book_id.required' => 'Please enter a book id',
            'book_id.exists' => 'Please enter a book id that exists',
            'book_id.integer' => 'Please enter a number for book id',
        ];
    }
}

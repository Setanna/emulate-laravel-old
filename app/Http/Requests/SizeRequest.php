<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'system' => 'required|max:65535',
            'height' => 'required|max:255',
            'weight' => 'required|max:255',
            'flight_modifier' => 'required|numeric|min:-20|max:20',
            'stealth_modifier' => 'required|numeric|min:-20|max:20',
            'damage_reduction_modifier' => 'required|numeric|min:-20|max:20',
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
            'description.required' => 'Please enter a description',
            'description.max' => 'Please limit description to 255 characters',
            'system.required' => 'Please enter a system explanation',
            'system.max' => 'Please limit system text to 65,535 characters',
            'height.required' => 'Please enter a height',
            'height.max' => 'Please limit height to 255 characters',
            'weight.required' => 'Please enter a weight',
            'weight.max' => 'Please limit weight to 255 characters',
            'flight_modifier.required' => 'Please enter a flight modifier',
            'flight_modifier.numeric' => 'Please enter a number for flight modifier',
            'flight_modifier.max' => 'Please enter a number below 21',
            'flight_modifier.min' => 'Please enter a number above -21',
            'attack_modifier.required' => 'Please enter a attack modifier',
            'attack_modifier.numeric' => 'Please enter a number for attack modifier',
            'attack_modifier.max' => 'Please enter a number below 21',
            'attack_modifier.min' => 'Please enter a number above -21',
            'defense_modifier.required' => 'Please enter a defense modifier',
            'defense_modifier.numeric' => 'Please enter a number for defense modifier',
            'defense_modifier.max' => 'Please enter a number below 21',
            'defense_modifier.min' => 'Please enter a number above -21',
            'stealth_modifier.required' => 'Please enter a stealth modifier',
            'stealth_modifier.numeric' => 'Please enter a number for stealth modifier',
            'stealth_modifier.max' => 'Please enter a number below 21',
            'stealth_modifier.min' => 'Please enter a number above -21',
            'damage_modifier.required' => 'Please enter a damage modifier',
            'damage_modifier.numeric' => 'Please enter a number for damage  modifier',
            'damage_modifier.max' => 'Please enter a number below 21',
            'damage_modifier.min' => 'Please enter a number above -21',
            'damage_reduction_modifier.required' => 'Please enter a damage reduction modifier',
            'damage_reduction_modifier.numeric' => 'Please enter a number for damage reduction modifier',
            'damage_reduction_modifier.max' => 'Please enter a number below 21',
            'damage_reduction_modifier.min' => 'Please enter a number above -21'
        ];
    }
}

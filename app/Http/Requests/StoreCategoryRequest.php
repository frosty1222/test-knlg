<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        // Add any custom validation logic if needed
        $validator->after(function ($validator) {
            $this->customValidation($validator);
        });
    }

    /**
     * Perform any additional custom validation.
     *
     * @return void
     */
    protected function customValidation($validator)
    {
        $name = $this->input('name');

        // Example of additional custom validation logic
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $this->validator->errors()->add('name', 'The name must only contain letters and spaces.');
        }
    }
}

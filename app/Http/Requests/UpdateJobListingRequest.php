<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobListingRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'max:255'],
            'company' => ['sometimes', 'string', 'max:255'],
            'company_logo' => ['string', 'max:255'],
            'location' => ['sometimes', 'string', 'max:255'],
            'category' => ['sometimes', 'string', 'max:255'],
            'salary' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'benefits' => ['nullable', 'string'],
            'type' => ['sometimes', 'string', 'max:255'],
            'work_condition' => ['sometimes', 'string', 'max:255'],
        ];
    }
}

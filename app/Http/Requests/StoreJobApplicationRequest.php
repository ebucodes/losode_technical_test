<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJobApplicationRequest extends FormRequest
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
        $job_id = $this->route('job_id');
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('job_applications')->where(function ($query) use ($job_id) {
                    return $query->where('job_id', $job_id);
                })
            ],
            'phone' => ['required', 'string', Rule::unique('job_applications')->where(function ($query) use ($job_id) {
                return $query->where('job_id', $job_id);
            })],
            'location' => ['required', 'string', 'max:255'],
            'cv' => ['required', 'file', 'mimes:pdf', 'max:2048']
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This user has already applied for this job using this email address.',
            'phone.unique' => 'This user has already applied for this job using this phone number.',
        ];
    }
}

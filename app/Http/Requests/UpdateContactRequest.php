<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
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
        $contactId = $this->route('contact')->id;
        return [
            'name' => ['required', 'string', 'min:6'],
            'contact' => ['required', 'string', 'digits:9', Rule::unique('contacts', 'contact')->ignore($contactId)],
            'email' => ['required', 'email', Rule::unique('contacts', 'email')->ignore($contactId)]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Name is required.',
            'name.min'         => 'Name must be at least 6 characters.',
            'contact.required' => 'Contact is required.',
            'contact.digits'   => 'Contact must be exactly 9 digits.',
            'email.required'   => 'Email is required.',
            'email.email'      => 'Email must be a valid email address.',
            'email.unique'     => 'This email is already in use.',
            'contact.unique'   => 'This contact number is already in use.',
        ];
    }
}

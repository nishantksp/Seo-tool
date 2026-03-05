<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebsiteUpdateRequest extends FormRequest
{
    /**
     * Allow admin to update websites.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for updating a website.
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')->where('role', 'client')],
            'domain' => ['required', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'niche' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:active,paused'],
        ];
    }
}

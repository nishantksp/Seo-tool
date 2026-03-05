<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebsiteStoreRequest extends FormRequest
{
    /**
     * Allow admin to create websites.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a website.
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

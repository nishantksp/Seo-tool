<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'domain' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'integer'],
            'country' => ['nullable', 'string', 'max:255'],
            'niche' => ['nullable', 'string', 'max:255'],
        ];
    }
}

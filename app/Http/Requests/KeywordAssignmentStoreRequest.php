<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeywordAssignmentStoreRequest extends FormRequest
{
    /**
     * Allow admin to create keyword assignments.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating keyword assignments.
     */
    public function rules(): array
    {
        return [
            'website_id' => ['required', 'integer', 'exists:websites,id'],
            'keyword' => ['required', 'string', 'max:255'],
            'search_volume' => ['nullable', 'integer', 'min:0'],
            'difficulty' => ['nullable', 'integer', 'min:0'],
            'target_url' => ['nullable', 'string', 'max:255'],
            'priority' => ['nullable', 'integer', 'min:1', 'max:10'],
            'status' => ['nullable', 'string', 'max:20', 'in:active,paused,archived'],
        ];
    }
}

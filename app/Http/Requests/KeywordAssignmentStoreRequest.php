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
            'website_id' => ['required','exists:websites,id'],
        'keyword' => ['required','string','max:255'],
        'search_volume' => ['nullable','integer','min:0'],
        'difficulty' => ['nullable','integer','min:0'],
        'intent' => ['nullable','in:informational,transactional,navigational'],
        'language' => ['nullable','string','max:10'],
        'country' => ['nullable','string','max:100'],
        'cpc' => ['nullable','numeric','min:0'],
        'competition' => ['nullable','integer','min:0','max:100'],
        'is_branded' => ['nullable','boolean'],

        'target_url' => ['nullable','string','max:255'],
        'priority' => ['nullable','integer','min:1','max:10'],
        'status' => ['required','in:active,paused'],
        'notes' => ['nullable','string','max:500'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeywordRankingStoreRequest extends FormRequest
{
    /**
     * Allow admin to store ranking updates.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a ranking entry.
     */
    public function rules(): array
    {
        return [
            'keyword_assignment_id' => ['required', 'integer', 'exists:keyword_assignments,id'],
            'rank' => ['required', 'integer', 'min:1'],
            'search_engine' => ['nullable', 'string', 'max:50', 'in:google,bing,yahoo'],
            'location' => ['nullable', 'string', 'max:100'],
            'device_type' => ['nullable', 'string', 'max:20', 'in:desktop,mobile'],
        ];
    }
}

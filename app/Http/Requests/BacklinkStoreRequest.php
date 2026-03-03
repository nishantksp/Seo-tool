<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BacklinkStoreRequest extends FormRequest
{
    /**
     * Allow authenticated admins to create backlinks.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a backlink.
     */
    public function rules(): array
    {
        return [
            'website_id' => ['required', 'integer', 'exists:websites,id'],
            'source_url' => ['required', 'url', 'max:2048'],
            'target_url' => ['nullable', 'url', 'max:2048'],
            'anchor_text' => ['nullable', 'string', 'max:255'],
            'link_type' => ['required', 'string', 'in:dofollow,nofollow'],
            'da' => ['nullable', 'integer', 'min:0', 'max:100'],
            'status' => ['required', 'string', 'in:active,lost'],
        ];
    }
}

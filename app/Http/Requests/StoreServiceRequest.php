<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->role === 'owner';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'             => ['required','string','max:255'],
            'description'      => ['nullable','string'],
            'duration_minutes' => ['required','integer','min:1','max:480'],
            'price_cents'      => ['required','integer','min:0'],
            'is_active'        => ['sometimes','boolean'],
        ];
    }
}

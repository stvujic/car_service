<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkingHoursRequest extends FormRequest
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
            'items'                         => ['required','array','size:7'],
            'items.*.day_of_week'           => ['required','integer','between:0,6'],
            'items.*.open_time'             => ['required','date_format:H:i'],
            'items.*.close_time'            => ['required','date_format:H:i','after:items.*.open_time'],
            'items.*.break_start'           => ['nullable','date_format:H:i'],
            'items.*.break_end'             => ['nullable','date_format:H:i'],
        ];
    }
}

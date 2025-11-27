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
            'items' => ['required', 'array'],
            'items.*.day_of_week' => ['required', 'integer', 'between:0,6'],
            'items.*.is_working_day' => ['required', 'in:0,1'],
            'items.*.open_time' => ['nullable', 'date_format:H:i'],
            'items.*.close_time' => ['nullable', 'date_format:H:i'],
            'items.*.break_start' => ['nullable', 'date_format:H:i'],
            'items.*.break_end' => ['nullable', 'date_format:H:i'],
        ];
    }

    public function messages(): array
    {
        return [
            'items.*.open_time.required_if' => 'Open time is required for working days.',
            'items.*.close_time.required_if' => 'Close time is required for working days.',
            'items.*.close_time.after' => 'Close time must be after open time.',
            'items.*.break_end.after' => 'Break end must be after break start.',
        ];
    }
}

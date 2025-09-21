<?php
namespace app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateToeicTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;  // Mengizinkan semua pengguna
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date|after_or_equal:today',
            'zoom_link' => 'required|url|starts_with:https://zoom.us/,https://us02web.zoom.us/',
            'max_participants' => 'required|integer|min:1|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'The test date is required.',
            'date.date' => 'Please enter a valid date.',
            'date.after_or_equal' => 'The test date must be today or in the future.',

            'zoom_link.required' => 'The Zoom link is required.',
            'zoom_link.url' => 'Please enter a valid URL for the Zoom link.',
            'zoom_link.starts_with' => 'The Zoom link must be a valid Zoom meeting URL.',

            'max_participants.required' => 'The maximum number of participants is required.',
            'max_participants.integer' => 'The maximum participants must be a whole number.',
            'max_participants.min' => 'The minimum number of participants is 1.',
            'max_participants.max' => 'The maximum number of participants cannot exceed 1000.',
        ];
    }
}

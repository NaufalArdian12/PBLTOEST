<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudyProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'study_program_name' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'study_program_name.required' => 'Nama program studi harus diisi.',
            'study_program_name.string' => 'Nama program studi harus berupa teks.',
            'study_program_name.max' => 'Nama program studi tidak boleh lebih dari 100 karakter.',
        ];
    }
}

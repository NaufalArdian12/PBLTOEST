<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMajorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'study_program_id' => ['required', 'integer', 'exists:study_programs,id'],
            'major_name' => 'required|string|max:100'
        ];
    }

    public function messages()
    {
        return [
            'study_program_id.required' => 'Program studi harus dipilih.',
            'study_program_id.exists' => 'Program studi yang dipilih tidak valid.',
            'major_name.required' => 'Nama jurusan harus diisi.',
            'major_name.string' => 'Nama jurusan harus berupa teks.',
            'major_name.max' => 'Nama jurusan tidak boleh lebih dari 100 karakter.'
        ];
    }
}

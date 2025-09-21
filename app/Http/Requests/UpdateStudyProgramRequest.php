<?php

namespace app\Http\Requests;

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
            'major_id' => 'nullable|exists:majors,id',
            'campus_id' => 'required|exists:campuses,id',
        ];
    }

    public function messages()
    {
        return [
            'study_program_name.required' => 'Nama program studi harus diisi.',
            'study_program_name.string' => 'Nama program studi harus berupa teks.',
            'study_program_name.max' => 'Nama program studi tidak boleh lebih dari 100 karakter.',
            'major_id.exists' => 'Jurusan yang dipilih tidak valid.',
            'campus_id.required' => 'Kampus harus dipilih.',
            'campus_id.exists' => 'Kampus yang dipilih tidak valid.',
        ];
    }
}

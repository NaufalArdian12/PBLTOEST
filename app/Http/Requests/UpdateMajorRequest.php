<?php

namespace app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMajorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'campus_id' => ['required', 'integer', 'exists:campuses,id'],
            'major_name' => 'required|string|max:100'
        ];
    }

    public function messages()
    {
        return [
            'campus_id.required' => 'Kampus id harus dipilih.',
            'campus_id.exists' => 'Kampus yang dipilih tidak valid.',
            'major_name.required' => 'Nama jurusan harus diisi.',
            'major_name.string' => 'Nama jurusan harus berupa teks.',
            'major_name.max' => 'Nama jurusan tidak boleh lebih dari 100 karakter.'
        ];
    }
}

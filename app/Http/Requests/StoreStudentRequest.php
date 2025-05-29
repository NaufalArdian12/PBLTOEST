<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'NIM' => 'required|string|unique:students,NIM',
            'NIK' => 'required|string|unique:students,NIK',
            'study_program_id' => 'required|exists:study_programs,id',
            'major_id' => 'required|exists:majors,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email harus valid.',
            'password.required' => 'Password harus diisi.',
            'NIM.required' => 'NIM harus diisi.',
            'NIK.required' => 'NIK harus diisi.',
            'study_program_id.required' => 'Program studi harus dipilih.',
            'major_id.required' => 'Jurusan harus dipilih.',
        ];
    }
}

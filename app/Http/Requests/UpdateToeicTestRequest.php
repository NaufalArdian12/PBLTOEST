<?php
namespace App\Http\Requests;

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
            'toeic_test_name' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'toeic_test_name.required' => 'Nama TOEIC Test harus diisi.',
            'toeic_test_name.string' => 'Nama TOEIC Test harus berupa teks.',
            'toeic_test_name.max' => 'Nama TOEIC Test tidak boleh lebih dari 100 karakter.',
        ];
    }
}

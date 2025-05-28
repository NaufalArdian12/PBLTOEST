<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Mengizinkan semua pengguna untuk mengakses request ini
        return true;
    }

    public function rules(): array
    {
        return [
            'registration_date' => 'required|date',
            'status' => 'required|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'registration_date.required' => 'Tanggal registrasi harus diisi.',
            'registration_date.date' => 'Tanggal registrasi harus dalam format yang valid.',
            'status.required' => 'Status registrasi harus diisi.',
            'status.string' => 'Status registrasi harus berupa string.',
            'status.max' => 'Status registrasi tidak boleh lebih dari 20 karakter.',
        ];
    }
}

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
            'scan_ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'scan_ktm' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pas_photo' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'current_address' => 'nullable|string|max:255',
            'origin_address' => 'nullable|string|max:255',
            'telephone_number' => 'nullable|string|max:15',
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
            'NIM.unique' => 'NIM sudah digunakan oleh mahasiswa lain.',
            'NIK.required' => 'NIK harus diisi.',
            'NIK.unique' => 'NIK sudah digunakan oleh mahasiswa lain.',
            'study_program_id.required' => 'Program studi harus dipilih.',
            'scan_ktp.required' => 'Scan KTP harus diunggah.',
            'scan_ktm.required' => 'Scan KTM harus diunggah.',
            'pas_photo.required' => 'Foto harus diunggah.',
            'current_address.string' => 'Alamat saat ini harus berupa teks.',
            'current_address.max' => 'Alamat saat ini tidak boleh lebih dari 255 karakter.',
            'origin_address.string' => 'Alamat asal harus berupa teks.',
            'origin_address.max' => 'Alamat asal tidak boleh lebih dari 255 karakter.',
            'telephone_number.string' => 'Nomor telepon harus berupa teks.',
            'telephone_number.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
        ];
    }
}

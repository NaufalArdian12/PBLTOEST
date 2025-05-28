<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Mengizinkan semua pengguna untuk melakukan request
    }

    public function rules(): array
    {
        $adminId = $this->route('id');  // Mengambil ID dari URL route
        return [
            'admin_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $adminId,
            'password' => 'nullable|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'admin_name.required' => 'Nama admin harus diisi.',
            'email.required' => 'Email harus diisi.',
        ];
    }
}

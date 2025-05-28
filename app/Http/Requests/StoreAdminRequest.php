<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Mengizinkan semua pengguna untuk melakukan request
    }

    public function rules(): array
    {
        return [
            'admin_name' => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'admin_name.required' => 'Nama admin harus diisi.',
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ];
    }
}

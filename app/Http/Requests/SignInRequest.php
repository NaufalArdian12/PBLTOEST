<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Mengizinkan request ini tanpa batasan khusus
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email', // Validasi email, harus ada dalam tabel 'users'
            'password' => 'required|min:6', // Validasi password
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.exists' => 'Email tidak ditemukan.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ];
    }
}

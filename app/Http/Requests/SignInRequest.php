<?php
namespace app\Http\Requests;

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
            'NIM' => 'required|string',       // Boleh NIM atau email, jadi cukup string saja
            'password' => 'required|min:8',   // Validasi password tetap
        ];
    }

    public function messages()
    {
        return [
            'NIM.required' => 'NIM atau Email harus diisi.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ];
    }

}

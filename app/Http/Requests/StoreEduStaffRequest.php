<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEduStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Mengizinkan semua pengguna untuk melakukan request
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'NIP'      => 'required|string|unique:educational_staff,NIP',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama staf harus diisi.',
            'email.required' => 'Email harus diisi.',
            'password.required' => 'Password harus diisi.',
            'NIP.required' => 'NIP harus diisi.',
        ];
    }
}

<?php

namespace app\Http\Requests;

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
            'name' => 'required|string|max:255' . $adminId,
            'email' => 'required|email|unique:users,email,' . $adminId,
            'password' => 'nullable|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama admin harus diisi.',
            'email.required' => 'Email harus diisi.',
        ];
    }
}

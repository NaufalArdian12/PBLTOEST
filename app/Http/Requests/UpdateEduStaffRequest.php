<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEduStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Mengizinkan semua pengguna untuk melakukan request
    }

    public function rules(): array
    {
        $staffId = $this->route('id');  // Mengambil ID dari URL route
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $staffId,
            'NIP'      => 'required|string|unique:educational_staff,NIP,' . $staffId,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama staf harus diisi.',
            'email.required' => 'Email must be filled.',
            'NIP.required' => 'NIP must be filled.',
        ];
    }
}

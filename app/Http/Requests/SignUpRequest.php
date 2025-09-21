<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Jika Anda ingin mengizinkan request ini hanya untuk pengguna yang sudah terautentikasi, kembalikan true
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|confirmed', // Mengharuskan konfirmasi password
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name must be filled in.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email.',
            'password.required' => 'Password must be filled in.',
            'password.min' => 'The password must be more than 6 characters long.',
            'password.confirmed' => 'Confirmation password is not correct.',
        ];
    }
}

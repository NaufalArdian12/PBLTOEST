<?php
namespace app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Mengizinkan semua pengguna untuk mengakses request ini
        return true;
    }


    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:students,nim',
            'nik' => 'required|string',
            'no_wa' => 'required|string',
            'alamat_asal' => 'required|string',
            'alamat_sekarang' => 'required|string',
            'program_studi' => 'required|string',
            'jurusan' => 'required|string',
            'kampus' => 'required|string|in:Utama,PSDKU Kediri,PSDKU Lumajang,PSDKU Pamekasan',
            'scan_ktp' => 'required|image|max:2048',
            'scan_ktm' => 'required|image|max:2048',
            'pas_foto' => 'required|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama harus diisi.',
            'nim.required' => 'NIM harus diisi.',
            'nim.unique' => 'NIM sudah terdaftar.',
            'nik.required' => 'NIK harus diisi.',
            'no_wa.required' => 'Nomor WA harus diisi.',
            'alamat_asal.required' => 'Alamat asal harus diisi.',
            'alamat_sekarang.required' => 'Alamat sekarang harus diisi.',
            'program_studi.required' => 'Program studi harus diisi.',
            'jurusan.required' => 'Jurusan harus diisi.',
            'kampus.required' => 'Kampus harus dipilih.',
            'kampus.in' => 'Kampus yang dipilih tidak valid.',
            'scan_ktp.required' => 'Scan KTP harus diunggah.',
            'scan_ktp.image' => 'File KTP harus berupa gambar.',
            'scan_ktp.max' => 'Ukuran file KTP maksimal 2MB.',
            'scan_ktm.required' => 'Scan KTM harus diunggah.',
            'scan_ktm.image' => 'File KTM harus berupa gambar.',
            'scan_ktm.max' => 'Ukuran file KTM maksimal 2MB.',
            'pas_foto.required' => 'Pas foto harus diunggah.',
            'pas_foto.image' => 'File foto harus berupa gambar.',
            'pas_foto.max' => 'Ukuran file foto maksimal 2MB.',
        ];
    }
}

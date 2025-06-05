<?php
namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\User;  // Import model User
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{

    public function profile()
    {
        // Logika untuk menampilkan profil mahasiswa
        return view('mahasiswa.profile');
    }

    public function sertifikat()
    {
        // Logika download sertifikat
        return response()->download(public_path('sertifikat/jupri.pdf'));
    }

    // Menampilkan form untuk update profile
    public function edit()
    {
        // Ambil data user yang sedang login
        $user = auth()->user();

        // Tampilkan form untuk edit profile
        return view('mahasiswa.edit-profile', compact('user'));
    }

    // Menangani update data profile
    public function update(Request $request)
    {
        // Validasi inputan dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Ambil data user yang sedang login
        $user = auth()->user();

        // Update data user
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Jika ada password baru, maka update password
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('mahasiswa.profile')->with('success', 'Profile berhasil diperbarui');
    }
}

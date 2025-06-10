<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{

    // Menampilkan halaman profile berdasahrkan role user
    public function index()
    {
        $user = auth()->user();
        // Cek apakah user adalah admin
        if (auth()->user()->role->name === 'Admin') {
            return view('admin.profile');
        } else{
            return view('mahasiswa.profile');
        }
    }
    // Menampilkan form edit profile
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    // Mengupdate data profile
    public function update(Request $request)
    {
        $user = auth()->user();

        // Validasi untuk data user
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'NIM' => 'nullable|string|max:20',
            'pas_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'scan_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'scan_ktm' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update atau create data student
        if ($user->student) {
            $studentData = [
                'NIM' => $request->NIM,
            ];

            // Handle file uploads
            if ($request->hasFile('pas_photo')) {
                $studentData['pas_photo'] = $this->uploadFile($request->file('pas_photo'), 'pas_photos');
            }

            if ($request->hasFile('scan_ktp')) {
                $studentData['scan_ktp'] = $this->uploadFile($request->file('scan_ktp'), 'ktp_scans');
            }

            if ($request->hasFile('scan_ktm')) {
                $studentData['scan_ktm'] = $this->uploadFile($request->file('scan_ktm'), 'ktm_scans');
            }

            $user->student()->update($studentData);
        } else {
            // Jika student belum ada, buat baru
            $user->student()->create([
                'NIM' => $request->NIM,
                'pas_photo' => $request->hasFile('pas_photo') ? $this->uploadFile($request->file('pas_photo'), 'pas_photos') : null,
                'scan_ktp' => $request->hasFile('scan_ktp') ? $this->uploadFile($request->file('scan_ktp'), 'ktp_scans') : null,
                'scan_ktm' => $request->hasFile('scan_ktm') ? $this->uploadFile($request->file('scan_ktm'), 'ktm_scans') : null,
            ]);
        }

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }

    // Mengupdate password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    // Helper untuk upload file
    private function uploadFile($file, $folder)
    {
        $filename = time() . '_' . auth()->id() . '_' . $file->getClientOriginalName();
        return $file->storeAs($folder, $filename, 'public');
    }
}

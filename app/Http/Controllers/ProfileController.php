<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use app\Models\StudyProgramModels;
use app\Models\StudentModels;

class ProfileController extends Controller
{

    // Menampilkan halaman profile berdasahrkan role user
    public function index()
    {
        $studyPrograms = StudyProgramModels::all();
        // Cek apakah user adalah admin
        if (auth()->user()->role->name === 'Admin') {
            return view('admin.profile');
        } else {
            return view('mahasiswa.profile', compact('studyPrograms'));
        }
    }
    // Menampilkan form edit profile
    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }


    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'NIM' => 'nullable|string|max:20',
            'current_address' => 'nullable|string|max:255',
            'origin_address' => 'nullable|string|max:255',
            'telephone_number' => 'nullable|string|max:20',
            'study_program_id' => 'nullable|exists:study_programs,id',
            'pas_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'scan_ktp' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048',
            'scan_ktm' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:2048',
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update user name
        $user->update([
            'name' => $request->name,
        ]);

        // Update password jika current_password diisi
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah'])->withInput();
            }

            if ($request->filled('password')) {
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }
        }

        // Update atau create student data
        $studentsData = [
            'NIM' => $request->NIM,
            'current_address' => $request->current_address,
            'origin_address' => $request->origin_address,
            'telephone_number' => $request->telephone_number,
            'study_program_id' => $request->study_program_id,
        ];

        // File uploads
        if ($request->hasFile('pas_photo')) {
            $studentsData['pas_photo'] = $request->file('pas_photo')->store('photos');
        }

        if ($request->hasFile('scan_ktp')) {
            $studentsData['scan_ktp'] = $request->file('scan_ktp')->store('scans');
        }

        if ($request->hasFile('scan_ktm')) {
            $studentsData['scan_ktm'] = $request->file('scan_ktm')->store('scans');
        }

        if ($user->students) {
            $user->students()->update($studentsData);
        } else {
            $user->students()->create($studentsData);
        }

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui');
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

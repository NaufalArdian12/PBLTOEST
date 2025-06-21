<?php

namespace App\Http\Controllers\Admin;

use App\Models\StudentModels;
use App\Models\UserModels;
use App\Models\MajorModels;
use App\Models\StudyProgramModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = StudentModels::with(['user', 'studyProgram'])->get();
        return view('admin.mahasiswa.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //menambahkan data program studi dan jurusan dari model terkait
        $studyPrograms = StudyProgramModels::all();
        return view('admin.mahasiswa.create', compact('studyPrograms'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = StudentModels::with(['user', 'studyProgram'])->findOrFail($id);
        $scanKtpPath = Storage::url('app/' . $student->scan_ktp);
        $scanKtmPath = Storage::url('app/' . $student->scan_ktm);
        $pasPhotoPath = Storage::url('app/' . $student->pas_photo);
        return view('admin.mahasiswa.show', compact('student', 'scanKtpPath', 'scanKtmPath', 'pasPhotoPath'));
    }

    public function showKtp($id)
    {
        $student = StudentModels::findOrFail($id);

        // Gunakan sistem storage Laravel
        $filePath = $student->scan_ktp;

        if (Storage::exists($filePath)) {
            return response()->file(storage_path('app/' . $filePath));
        }

        return redirect()->back()->with('error', 'File KTP tidak ditemukan.');
    }
    public function showKtm($id)
    {
        $student = StudentModels::findOrFail($id);

        // Gunakan sistem storage Laravel
        $filePath = $student->scan_ktm;

        if (Storage::exists($filePath)) {
            return response()->file(storage_path('app/' . $filePath));
        }

        return redirect()->back()->with('error', 'File KTM tidak ditemukan.');
    }
    public function showPasPhoto($id)
    {
        $student = StudentModels::findOrFail($id);

        // Gunakan sistem storage Laravel
        $filePath = $student->pas_photo;

        if (Storage::exists($filePath)) {
            return response()->file(storage_path('app/' . $filePath));
        }

        return redirect()->back()->with('error', 'Foto tidak ditemukan.');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(string $id)
    {
        $student = StudentModels::findOrFail($id);
        $student->delete();

        return redirect()->route('student.index')
            ->with('success', 'Data mahasiswa berhasil dihapus (soft delete)');
    }

    /**
     * Display a listing of trashed resources.
     */
    public function trashed()
    {
        $students = StudentModels::onlyTrashed()->with(['user', 'studyProgram', 'major'])->get();
        return view('admin.mahasiswa.trashed', compact('students'));
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore(string $id)
    {
        $student = StudentModels::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('admin.mahasiswa.trashed')
            ->with('success', 'Data mahasiswa berhasil dipulihkan');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete(string $id)
    {
        $student = StudentModels::onlyTrashed()->findOrFail($id);

        // Hapus user terkait jika diperlukan
        // $student->user()->delete();

        $student->forceDelete();

        return redirect()->route('admin.mahasiswa.trashed')
            ->with('success', 'Data mahasiswa berhasil dihapus permanen');
    }

    /**
     * AJAX version of store
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $request->validated();
            // Simpan file dan ambil path-nya
            $scan_ktp_path = $request->file('scan_ktp')->store('private/scans');
            $scan_ktm_path = $request->file('scan_ktm')->store('private/scans');
            $pas_photo_path = $request->file('pas_photo')->store('private/photos');

            // Buat user terlebih dahulu
            $user = UserModels::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'Student',
            ]);
            // Buat data mahasiswa terkait dan simpan path file
            $student = StudentModels::create([
                'user_id' => $user->id,
                'NIM' => $request->NIM,
                'NIK' => $request->NIK,
                'study_program_id' => $request->study_program_id,
                'scan_ktp' => $scan_ktp_path,
                'scan_ktm' => $scan_ktm_path,
                'pas_photo' => $pas_photo_path,
                'current_address' => $request->current_address,
                'origin_address' => $request->origin_address,
                'telephone_number' => $request->telephone_number,
            ]);
            // Redirect setelah data berhasil disimpan
            return redirect()->route('student.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangani error jika ada masalah dengan penyimpanan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $student = StudentModels::with(['user', 'studyProgram'])->findOrFail($id);
        $studyPrograms = StudyProgramModels::all();
        $majors = MajorModels::all();

        return view('admin.mahasiswa.edit', compact('student', 'studyPrograms', 'majors'));
    }

    public function update(Request $request, $id)
    {
        // Find the student by ID
        $student = StudentModels::find($id);

        if ($student) {
            // Update user details (name, email)
            $student->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Handle password update (only if provided)
            if ($request->filled('password')) {
                $student->user->update([
                ]);
            }
            // Update student-related fields
            $student->update([
                'NIM' => $request->NIM,
                'NIK' => $request->NIK,
                'study_program_id' => $request->study_program_id,
                'current_address' => $request->current_address,
                'origin_address' => $request->origin_address,
                'telephone_number' => $request->telephone_number,
            ]);

            // Handle file uploads (KTP, KTM, Passport Photo)
            if ($request->hasFile('scan_ktp')) {
                $student->update([
                    'scan_ktp' => $request->file('scan_ktp')->store('private/scans')
                ]);
            }

            if ($request->hasFile('scan_ktm')) {
                $student->update([
                    'scan_ktm' => $request->file('scan_ktm')->store('private/scans')
                ]);
            }

            if ($request->hasFile('pas_photo')) {
                $student->update([
                    'pas_photo' => $request->file('pas_photo')->store('private/photos')
                ]);
            }
            // Return a success response
            return redirect()->route('student.index')->with('success', 'Data mahasiswa berhasil diperbarui');
        } else {
            // Return a failure response if student not found
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ])->withInput();
        }
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $student = StudentModels::find($id);
            if ($student) {
                // Soft delete data mahasiswa
                $student->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Data mahasiswa berhasil dihapus (soft delete)'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data mahasiswa tidak ditemukan'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }

    public function downloadKtp($filename)
    {
        $path = storage_path('app/private/scans/' . $filename);

        if (File::exists($path)) {
            return response()->download($path);
        }

        abort(404);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\StudentModels;
use App\Models\UserModels;
use App\Models\MajorModels;
use App\Models\StudyProgramModels;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;


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
        $majors = MajorModels::all();
        return view('admin.mahasiswa.create', compact('studyPrograms', 'majors'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = StudentModels::with(['user', 'studyProgram', 'major'])->findOrFail($id);
        return view('admin.mahasiswa.show', compact('student'));
    }


    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy(string $id)
    {
        $student = StudentModels::findOrFail($id);
        $student->delete();

        return redirect()->route('mahasiswa.index')
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
    public function store_ajax(StoreStudentRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi berhasil pada StoreStudentRequest
            // Buat user terlebih dahulu
            $user = UserModels::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'mahasiswa',
            ]);

            // Buat data mahasiswa terkait
            $student = StudentModels::create([
                'user_id' => $user->id,
                'NIM' => $request->NIM,
                'NIK' => $request->NIK,
                'study_program_id' => $request->study_program_id,
                'major_id' => $request->major_id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data mahasiswa berhasil ditambahkan',
                'data' => $student
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }


    public function show_ajax($id)
    {
        $student = StudentModels::with(['user', 'studyProgram', 'major'])->find($id);
        if ($student) {
            return response()->json([
                'status' => true,
                'data' => $student
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ]);
        }
    }

    public function edit_ajax($id)
    {
        $student = StudentModels::with('user')->find($id);
        if ($student) {
            $studyPrograms = StudyProgramModels::all();
            $majors = MajorModels::all();
            return response()->json([
                'status' => true,
                'data' => [
                    'student' => $student,
                    'studyPrograms' => $studyPrograms,
                    'majors' => $majors
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ]);
        }
    }

    public function update_ajax(UpdateStudentRequest $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $student = StudentModels::find($id);
            if ($student) {
                $student->user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                ]);

                $student->update([
                    'NIM' => $request->NIM,
                    'NIK' => $request->NIK,
                    'study_program_id' => $request->study_program_id,
                    'major_id' => $request->major_id,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Data mahasiswa berhasil diperbarui'
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

}

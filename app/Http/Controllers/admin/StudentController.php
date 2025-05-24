<?php

namespace App\Http\Controllers;

use App\Models\StudentModels;
use App\Models\UserModels;
use App\Models\MajorModels;
use App\Models\StudyProgramModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = StudentModels::with(['user', 'studyProgram', 'major'])->get();
        return view('mahasiswa.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //menambahkan data program studi dan jurusan dari model terkait
        $studyPrograms = StudyProgramModels::all();
        $majors = MajorModels::all();

        return view('mahasiswa.create', compact('studyPrograms', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'NIM' => 'required|string|unique:students,NIM',
            'NIK' => 'required|string|unique:students,NIK',
            'study_program_id' => 'required|exists:study_programs,id',
            'major_id' => 'required|exists:majors,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

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

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = StudentModels::with(['user', 'studyProgram', 'major'])->findOrFail($id);
        return view('mahasiswa.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = StudentModels::with('user')->findOrFail($id);
        $studyPrograms = StudyProgramModels::all();
        $majors = MajorModels::all();

        return view('mahasiswa.edit', compact('student', 'studyPrograms', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = StudentModels::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$student->user_id,
            'NIM' => 'required|string|unique:students,NIM,'.$id,
            'NIK' => 'required|string|unique:students,NIK,'.$id,
            'study_program_id' => 'required|exists:study_programs,id',
            'major_id' => 'required|exists:majors,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update data user
        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update data mahasiswa
        $student->update([
            'NIM' => $request->NIM,
            'NIK' => $request->NIK,
            'study_program_id' => $request->study_program_id,
            'major_id' => $request->major_id,
        ]);

        return redirect()->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui');
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
        return view('mahasiswa.trashed', compact('students'));
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore(string $id)
    {
        $student = StudentModels::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('mahasiswa.trashed')
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

        return redirect()->route('mahasiswa.trashed')
            ->with('success', 'Data mahasiswa berhasil dihapus permanen');
    }

    /**
     * AJAX version of store
     */
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
                'NIM' => 'required|string|unique:students,NIM',
                'NIK' => 'required|string|unique:students,NIK',
                'study_program_id' => 'required|exists:study_programs,id',
                'major_id' => 'required|exists:majors,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = UserModels::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'mahasiswa',
            ]);

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

        return redirect('/');
    }

    // Tambahkan method AJAX lainnya sesuai kebutuhan (show_ajax, edit_ajax, update_ajax, delete_ajax)
}

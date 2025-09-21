<?php

namespace App\Http\Controllers\Admin;

use app\Models\CampusModels;
use Illuminate\Http\Request;
use app\Models\StudyProgramModels;
use app\Models\MajorModels;
use app\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use app\Http\Requests\StoreStudyProgramRequest;
use app\Http\Requests\UpdateStudyProgramRequest;


class StudyProgramController extends Controller
{
    public function index()
    {
        $studyprograms = StudyProgramModels::with('major', 'campus')->get();
        $campuses = CampusModels::all();
        return view('admin.studyprogram.index', compact('studyprograms', 'campuses'));
    }

    public function create()
    {
        // Mendapatkan daftar kampus untuk dropdown
        $campuses = CampusModels::all();
        // Mengirimkan data kampus ke view
        $majors = MajorModels::all(); // Jika perlu, bisa juga mengambil daftar jurusan
        return view('admin.studyProgram.create', compact('campuses', 'majors'));
    }

    // Menyimpan data study_program baru
    public function store(StoreStudyProgramRequest $request)
    {
        // Data sudah tervalidasi pada saat request diterima
        StudyProgramModels::create($request->validated());
        return redirect()->route('studyprogram.index')->with('success', 'Data successfully created');
    }

    // Menampilkan detail study_program
    public function show(string $id)
    {
        $studyProgram = StudyProgramModels::find($id);
        return view('admin.studyprogram.show', compact('studyProgram'));
    }


    // Menampilkan halaman form edit study_program
    public function edit(string $id)
    {
        $studyProgram = StudyProgramModels::find($id);
        $campuses = CampusModels::all(); // Mendapatkan daftar kampus untuk dropdown
        $majors = MajorModels::all(); // Mendapatkan daftar jurusan untuk dropdown
        return view('admin.studyprogram.edit', compact('studyProgram', 'campuses', 'majors'));
    }

    public function update(UpdateStudyProgramRequest $request, $id)
    {
        // Data sudah tervalidasi pada saat request diterima
        $check = StudyProgramModels::find($id);
        if ($check) {
            $check->update($request->validated());
            return redirect()->route('studyprogram.index')->with('success', 'Data successfully updated');
        } else {
            return redirect()->route('studyprogram.index')->with('error', 'Data not found');
        }
    }

    // Menghapus data study_program
    public function destroy(Request $request, $id)
    {
        $study_program = StudyProgramModels::find($id);
        if ($study_program) {
            try {
                StudyProgramModels::destroy($id);
                return redirect()->route('studyprogram.index')->with('success', 'Data successfully deleted');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('studyprogram.index')->with('error', 'Data cannot be deleted because it is still in use');
            }
        } else {
            return redirect()->route('studyprogram.index')->with('error', 'Data not found');
        }
    }
}

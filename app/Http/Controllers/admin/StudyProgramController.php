<?php

namespace App\Http\Controllers\Admin;

use App\Models\CampusModels;
use Illuminate\Http\Request;
use App\Models\StudyProgramModels;
use App\Models\MajorModels;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreStudyProgramRequest;
use App\Http\Requests\UpdateStudyProgramRequest;


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


    public function list(Request $request)
    {
        $study_program = StudyProgramModels::select('id', 'study_program_name');

        return DataTables::of($study_program)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('action', function ($study_program) {  // menambahkan kolom action
                $btn = '<button onclick="modalAction(\'' . url('/study_program/' . $study_program->id . '/show') . '\')"
    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm mr-1">Detail</button>';

                $btn .= '<button onclick="modalAction(\'' . url('/study_program/' . $study_program->id . '/edit') . '\')"
    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-1">Edit</button>';

                $btn .= '<button onclick="modalAction(\'' . url('/study_program/' . $study_program->id . '/delete') . '\')"
    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>';

                return $btn;
            })
            ->rawColumns(['action']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
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
    public function confirm(string $id)
    {
        $study_program = StudyProgramModels::find($id);
        return view('study_program.confirm', ['study_program' => $study_program]);
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

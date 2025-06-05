<?php

namespace App\Http\Controllers\Admin;

use App\Models\CampusModels;
use Illuminate\Http\Request;
use App\Models\StudyProgramModels;
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

    public function create_ajax()
    {
        return view('study_program.create_ajax');
    }

    // Menyimpan data study_program baru
    public function store_ajax(StoreStudyProgramRequest $request)
    {
        // Data sudah tervalidasi pada saat request diterima
        if ($request->ajax() || $request->wantsJson()) {
            StudyProgramModels::create($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Data successfully saved'
            ]);
        }
        return redirect('/');
    }

    public function list(Request $request)
    {
        $study_program = StudyProgramModels::select('id', 'study_program_name');

        return DataTables::of($study_program)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('action', function ($study_program) {  // menambahkan kolom action
                $btn = '<button onclick="modalAction(\'' . url('/study_program/' . $study_program->id . '/show_ajax') . '\')"
    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm mr-1">Detail</button>';

                $btn .= '<button onclick="modalAction(\'' . url('/study_program/' . $study_program->id . '/edit_ajax') . '\')"
    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-1">Edit</button>';

                $btn .= '<button onclick="modalAction(\'' . url('/study_program/' . $study_program->id . '/delete_ajax') . '\')"
    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>';

                return $btn;
            })
            ->rawColumns(['action']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan detail study_program
    public function show_ajax(string $id)
    {
        $study_program = StudyProgramModels::find($id);
        return view('study_program.show_ajax', compact('study_program'));
    }


    // Menampilkan halaman form edit study_program
    public function edit_ajax(string $id)
    {
        $study_program = StudyProgramModels::find($id);
        return view('study_program.edit_ajax', compact('study_program'));
    }

    public function update_ajax(UpdateStudyProgramRequest $request, $id)
    {
        // Data sudah tervalidasi pada saat request diterima
        if ($request->ajax() || $request->wantsJson()) {
            $check = StudyProgramModels::find($id);
            if ($check) {
                $check->update($request->validated());
                return response()->json([
                    'status' => true,
                    'message' => 'Data successfully updated'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data not found'
                ]);
            }
        }
        return redirect('/');
    }

    // Menghapus data study_program
    public function confirm_ajax(string $id)
    {
        $study_program = StudyProgramModels::find($id);
        return view('study_program.confirm_ajax', ['study_program' => $study_program]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $study_program = StudyProgramModels::find($id);
            if ($study_program) {
                try {
                    StudyProgramModels::destroy($id);
                    return response()->json([
                        'status' => true,
                        'message' => 'Data successful deleted'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'study_program data cannot deleted because it is linked to another table.'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data is not found'
                ]);
            }
        }
        redirect('/');
    }
}

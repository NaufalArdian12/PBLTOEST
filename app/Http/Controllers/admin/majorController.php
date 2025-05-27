<?php

namespace App\Http\Controllers\Admin;

use App\Models\MajorModels;
use App\Models\StudyProgramModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;

class MajorController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Major List',
            'list' => ['Home', 'Major']
        ];
        $page = (object) [
            'title' => 'Major list integreted in system'
        ];
        $activeMenu = 'major';
        $study_program = StudyProgramModels::all();

        return view('barang.index', compact('breadcrumb', 'page', 'study_program', 'activeMenu'));
    }

    public function create_ajax()
    {
        $study_program = StudyProgramModels::all();
        return view('major.create_ajax')->with('study_program', $study_program);
    }

    // Menyimpan data major baru
    public function store_ajax(Request $request)
    {
        $request->validate([
            'study_program_id' => ['required', 'integer', 'exists:study_programs,study_program_id'],
            'major_name' => 'required|string|max: 100'
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'study_program_id' => ['required', 'integer', 'exists:study_programs,study_program_id'],
                'major_name' => 'required|string|max: 100'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed validation',
                    'msgField' => $validator->errors()
                ]);
            }
            MajorModels::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data successfully saved'
            ]);
        }
        redirect('/');
    }

    public function list(Request $request)
    {
        $major = MajorModels::select('id', 'major_name',  'study_program_id')->with('study_program');

        if ($request->study_program_id) {
            $major->where('study_program_id', $request->study_program_id);
        }

        return DataTables::of($major)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('action', function ($major) {  // menambahkan kolom action
                $btn  = '<button onclick="modalAction(\'' . url('/major/' . $major->id . '/show_ajax') . '\')"
    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm mr-1">Detail</button>';

                $btn .= '<button onclick="modalAction(\'' . url('/major/' . $major->id . '/edit_ajax') . '\')"
    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-1">Edit</button>';

                $btn .= '<button onclick="modalAction(\'' . url('/major/' . $major->id . '/delete_ajax') . '\')"
    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>';

                return $btn;
            })
            ->editColumn('study_program', function ($major) {
                return $major->study_program->study_program_name ?? '-';
            })
            ->rawColumns(['action']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan detail major
    public function show_ajax(string $id)
    {
        $major = MajorModels::with('study_program')->find($id);
        $study_program = StudyProgramModels::select('study_program_id', 'study_program_name')->get();
        return view('major.show_ajax', compact('study_program', 'major'));
    }


    // Menampilkan halaman form edit major
    public function edit_ajax(string $id)
    {
        $major = MajorModels::find($id);
        $study_program = StudyProgramModels::select('study_program_id', 'study_program_name')->get();
        return view('major.edit_ajax', compact('major', 'study_program'));
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'study_program_id' => ['required', 'integer', 'exists:study_programs,study_program_id'],
                'major_name' => 'required|string|max: 100',
            ];

            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,    // respon json, true: berhasil, false: gagal
                    'message'  => 'failed validation.',
                    'msgField' => $validator->errors()  // menunjukkan field mana yang error
                ]);
            }
            $check = MajorModels::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status'  => true,
                    'message' => 'Data succesful changed'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data not found'
                ]);
            }
        }
        redirect('/');
    }

    // Menghapus data major
    public function confirm_ajax(string $id)
    {
        $major = MajorModels::find($id);
        return view('major.confirm_ajax', ['major' => $major]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $major = MajorModels::find($id);
            if ($major) {
                try {
                    MajorModels::destroy($id);
                    return response()->json([
                        'status'  => true,
                        'message' => 'Data successful deleted'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status'  => false,
                        'message' => 'major data cannot deleted because the table connected with another table'
                    ]);
                }
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data is not found'
                ]);
            }
        }
        redirect('/');
    }
}

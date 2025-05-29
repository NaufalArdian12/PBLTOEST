<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ToeicTestModels;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreToeicTestRequest;
use App\Http\Requests\UpdateToeicTestRequest;

class ToeicTestController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Study Program List',
            'list' => ['Home', 'Study Program']
        ];
        $page = (object) [
            'title' => 'Study program list integreted in system'
        ];
        $activeMenu = 'toeic_test';
        $toeic_test = ToeicTestModels::all();

        return view('toeic_test.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function create_ajax()
    {
        return view('toeic_test.create_ajax');
    }

    // Menyimpan data toeic_test baru
    public function store_ajax(StoreToeicTestRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            ToeicTestModels::create($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Data successfully saved'
            ]);
        }
        return redirect('/');
    }

    public function list(Request $request)
    {
        $toeic_test = ToeicTestModels::select('id', 'toeic_test_name');

        return DataTables::of($toeic_test)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('action', function ($toeic_test) {  // menambahkan kolom action
                $btn = '<button onclick="modalAction(\'' . url('/toeic_test/' . $toeic_test->id . '/show_ajax') . '\')"
    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm mr-1">Detail</button>';

                $btn .= '<button onclick="modalAction(\'' . url('/toeic_test/' . $toeic_test->id . '/edit_ajax') . '\')"
    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-1">Edit</button>';

                $btn .= '<button onclick="modalAction(\'' . url('/toeic_test/' . $toeic_test->id . '/delete_ajax') . '\')"
    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>';

                return $btn;
            })
            ->rawColumns(['action']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan detail toeic_test
    public function show_ajax(string $id)
    {
        $toeic_test = ToeicTestModels::find($id);
        return view('toeic_test.show_ajax', compact('toeic_test'));
    }


    // Menampilkan halaman form edit toeic_test
    public function edit_ajax(string $id)
    {
        $toeic_test = ToeicTestModels::find($id);
        return view('toeic_test.edit_ajax', compact('toeic_test'));
    }

    public function update_ajax(UpdateToeicTestRequest $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $toeic_test = ToeicTestModels::find($id);
            if ($toeic_test) {
                $toeic_test->update($request->validated());
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

    // Menghapus data toeic_test
    public function confirm_ajax(string $id)
    {
        $toeic_test = ToeicTestModels::find($id);
        return view('toeic_test.confirm_ajax', ['toeic_test' => $toeic_test]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $toeic_test = ToeicTestModels::find($id);
            if ($toeic_test) {
                try {
                    ToeicTestModels::destroy($id);
                    return response()->json([
                        'status' => true,
                        'message' => 'Data successful deleted'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'toeic_test data cannot deleted because it is linked to another table.'
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

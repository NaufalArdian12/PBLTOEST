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
        // Fetch TOEIC tests created by the logged-in admin
        $toeicTests = ToeicTestModels::all();

        return view('admin.toeictest.index', compact('toeicTests'));
    }

    public function create()
    {
        $toeicTest = ToeicTestModels::all(); // Membuat instance baru dari ToeicTestModels
        return view('admin.toeictest.create', compact('toeicTest'));
    }

    // Menyimpan data toeic_test baru
    public function store(StoreToeicTestRequest $request)
    {
        $validated = $request->validated();

        $user = auth()->user();

        // Ambil admin_id dari relasi hasOne
        if ($user->admins) {
            $validated['admin_id'] = $user->admins->id;
        } else {
            return redirect()->back()->with('error', 'User tidak memiliki akses admin');
        }

        ToeicTestModels::create($validated);
        return redirect()->route('toeic.index')->with('success', 'TOEIC Test successfully created');
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
    public function show(string $id)
    {
        $toeicTests = ToeicTestModels::find($id);
        return view('admin.toeictest.show', compact('toeicTests'));
    }


    // Menampilkan halaman form edit toeic_test
    public function edit(string $id)
    {
        $toeicTest = ToeicTestModels::find($id);
        return view('admin.toeictest.edit', compact('toeicTest'));
    }

    public function update(UpdateToeicTestRequest $request, $id)
    {
        $toeic_test = ToeicTestModels::find($id);
        if ($toeic_test) {
            $toeic_test->update($request->validated());
            return redirect()->route('toeic.index')->with('success', 'Data successfully updated');
        } else {
            return redirect()->route('toeic.index')->with('error', 'Data not found');
        }
    }

    // Menghapus data toeic_test
    public function confirm_ajax(string $id)
    {
        $toeic_test = ToeicTestModels::find($id);
        return view('toeic_test.confirm_ajax', ['toeic_test' => $toeic_test]);
    }

    public function delete(Request $request, $id)
    {
        $toeic_test = ToeicTestModels::find($id);
        if ($toeic_test) {
            try {
                ToeicTestModels::destroy($id);
                return redirect()->route('toeic.index')->with('success', 'Data successfully deleted');
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('toeic.index')->with('error', 'Data cannot be deleted, it is still used in other tables');
            }
        } else {
            return redirect()->route('toeic.index')->with('error', 'Data not found');
        }
    }
}

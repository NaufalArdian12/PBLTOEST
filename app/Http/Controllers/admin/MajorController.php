<?php
namespace App\Http\Controllers\Admin;

use App\Models\MajorModels;
use App\Models\StudyProgramModels;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = MajorModels::all();
        return view('admin.major.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_ajax()
    {
        $study_program = StudyProgramModels::all();
        return view('major.create_ajax')->with('study_program', $study_program);
    }

    /**
     * Store a newly created resource in storage (AJAX).
     */
    public function store_ajax(StoreMajorRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Buat data major
            MajorModels::create($request->validated());
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil disimpan'
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }

    /**
     * Display the specified resource (AJAX).
     */
    public function show_ajax(string $id)
    {
        $major = MajorModels::with('study_program')->find($id);
        if ($major) {
            return response()->json([
                'status' => true,
                'data' => $major
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data major tidak ditemukan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource (AJAX).
     */
    public function edit_ajax(string $id)
    {
        $major = MajorModels::find($id);
        $study_program = StudyProgramModels::all();
        if ($major) {
            return response()->json([
                'status' => true,
                'data' => [
                    'major' => $major,
                    'study_program' => $study_program
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data major tidak ditemukan'
            ]);
        }
    }

    /**
     * Update the specified resource in storage (AJAX).
     */
    public function update_ajax(UpdateMajorRequest $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $major = MajorModels::find($id);
            if ($major) {
                $major->update($request->validated());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diperbarui'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data major tidak ditemukan'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }

    /**
     * Soft delete the specified resource (AJAX).
     */
    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $major = MajorModels::find($id);
            if ($major) {
                // Soft delete
                $major->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus (soft delete)'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data major tidak ditemukan'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }

    /**
     * Display a listing of trashed resources.
     */
    public function trashed()
    {
        $majors = MajorModels::onlyTrashed()->with('study_program')->get();
        return view('major.trashed', compact('majors'));
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore(string $id)
    {
        $major = MajorModels::onlyTrashed()->findOrFail($id);
        $major->restore();

        return redirect()->route('major.trashed')
            ->with('success', 'Data berhasil dipulihkan');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete(string $id)
    {
        $major = MajorModels::onlyTrashed()->findOrFail($id);
        $major->forceDelete();

        return redirect()->route('major.trashed')
            ->with('success', 'Data berhasil dihapus permanen');
    }
}

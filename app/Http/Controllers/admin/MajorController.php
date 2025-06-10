<?php
namespace App\Http\Controllers\Admin;

use App\Models\MajorModels;
use App\Models\StudyProgramModels;
use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\campusModels;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = MajorModels::all();
        $campuses = campusModels::all();
        return view('admin.major.index', compact('majors', 'campuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $campuses = campusModels::all();
        return view('admin.major.create', compact('campuses'));
    }

    /**
     * Store a newly created resource in storage (AJAX).
     */
    public function store_ajax(StoreMajorRequest $request)
    {
        try {
            // Create the major record with validated data from the request
            MajorModels::create($request->validated());

            // Redirect to the major index with success message
            return redirect()->route('major.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            // Catch general exception and redirect back with error message
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Display the specified resource (AJAX).
     */
    public function show(string $id)
    {
        try {
            $major = MajorModels::findOrFail($id);
            $campus = campusModels::findOrFail($major->campus_id);  

            return view('admin.major.show', compact('major', 'campus'));
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Data major tidak ditemukan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource (AJAX).
     */
    public function edit(string $id)
    {
        try {
            $major = MajorModels::findOrFail($id);
            $campuses = campusModels::all();

            return view('admin.major.edit', compact('major', 'campuses'));
        } catch (Exception $e) {
            return redirect()->back()->with([
                'false',
                'Data major tidak ditemukan'
            ]);
        }
    }

    /**
     * Update the specified resource in storage (AJAX).
     */
    public function update_ajax(UpdateMajorRequest $request, $id)
    {
        try {
            $majors = MajorModels::find($id);
            if ($majors) {
                $majors->update($request->validated());
                return redirect()->route('major.index')->with('success', 'Data major berhasil diperbarui');
            } else {
                return redirect()->back()->with([
                    'status' => false,
                    'message' => 'Data major tidak ditemukan'
                ])->withInput();
            }
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Soft delete the specified resource (AJAX).
     */
    public function destroy_ajax($id)
    {
        try {
            // Delete major record
            $major = MajorModels::findOrFail($id);
            $major->delete();

            // Redirect to index method (assuming it handles majors and campuses)
            return redirect()->route('major.index')->with('success', 'Data berhasil dihapus');
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Display a listing of trashed resources.
     */
    public function trashed()
    {
        $majors = MajorModels::onlyTrashed()->with('study_program')->get();
        return view('admin.major.trashed', compact('majors'));
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore(string $id)
    {
        $majors = MajorModels::onlyTrashed()->findOrFail($id);
        $majors->restore();

        return redirect()->route('major.trashed')
            ->with('success', 'Data berhasil dipulihkan');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete(string $id)
    {
        $majors = MajorModels::onlyTrashed()->findOrFail($id);
        $majors->forceDelete();

        return redirect()->route('major.trashed')
            ->with('success', 'Data berhasil dihapus permanen');
    }
}

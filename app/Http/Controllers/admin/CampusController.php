<?php

namespace App\Http\Controllers\Admin;

use App\Models\CampusModels;
use App\Models\MajorModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campuses = CampusModels::all();
        return view('admin.campus.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource (AJAX).
     */
    public function create_ajax()
    {
        return view('admin.campus.create_ajax');
    }

    /**
     * Store a newly created resource in storage (AJAX).
     */
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi input dan simpan data campus
            $validated = $request->validate([
                'campus_name' => 'required|string|max:255',
            ]);
            CampusModels::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Data campus berhasil disimpan'
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
        $campus = CampusModels::find($id);
        if ($campus) {
            return response()->json([
                'status' => true,
                'data' => $campus
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data campus tidak ditemukan'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource (AJAX).
     */
    public function edit_ajax(string $id)
    {
        $campus = CampusModels::find($id);
        if ($campus) {
            return response()->json([
                'status' => true,
                'data' => $campus
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data campus tidak ditemukan'
            ]);
        }
    }

    /**
     * Update the specified resource in storage (AJAX).
     */
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $campus = CampusModels::find($id);
            if ($campus) {
                // Validasi input dan update data campus
                $validated = $request->validate([
                    'campus_name' => 'required|string|max:255',
                ]);
                $campus->update($validated);

                return response()->json([
                    'status' => true,
                    'message' => 'Data campus berhasil diperbarui'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data campus tidak ditemukan'
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
            $campus = CampusModels::find($id);
            if ($campus) {
                // Soft delete
                $campus->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data campus berhasil dihapus (soft delete)'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data campus tidak ditemukan'
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
        $campuses = CampusModels::onlyTrashed()->get();
        return view('admin.campus.trashed', compact('campuses'));
    }

    /**
     * Restore the specified resource from trash.
     */
    public function restore(string $id)
    {
        $campus = CampusModels::onlyTrashed()->findOrFail($id);
        $campus->restore();

        return redirect()->route('admin.campus.trashed')
            ->with('success', 'Data campus berhasil dipulihkan');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete(string $id)
    {
        $campus = CampusModels::onlyTrashed()->findOrFail($id);
        $campus->forceDelete();

        return redirect()->route('admin.campus.trashed')
            ->with('success', 'Data campus berhasil dihapus permanen');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use app\Models\CampusModels;
use app\Models\MajorModels;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Exception;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Campus',
            'list' => ['Home', 'Campus']
        ];

        $page = (object) [
            'title' => 'Daftar campus yang terdaftar dalam sistem'
        ];

        $activeMenu = 'campus';
        $campuses = CampusModels::paginate(10); // Pagination with 10 items per page

        return view('admin.campus.index', compact('breadcrumb', 'page', 'activeMenu', 'campuses'));
    }

    /**
     * Get data for DataTables (AJAX).
     */
    public function list(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json(['error' => 'Invalid request'], 400);
        }

        $campuses = CampusModels::select('id', 'campus_name', 'created_at', 'updated_at');

        return DataTables::of($campuses)
            ->addIndexColumn()
            ->addColumn('aksi', function ($campus) {
                $btn = '<div class="btn-group" role="group">';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/campus/' . $campus->id . '/show_detail_ajax') . '\')" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></button>';
                $btn .= '<button onclick="modalAction(\'' . url('/admin/campus/' . $campus->id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></button>';
                $btn .= '<button onclick="deleteData(\'' . url('/admin/campus/' . $campus->id) . '\')" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash-alt"></i></button>';
                $btn .= '</div>';
                return $btn;
            })
            ->editColumn('created_at', function ($campus) {
                return $campus->created_at ? $campus->created_at->format('d/m/Y H:i') : '-';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource (AJAX).
     */
    public function create()
    {
        return view('admin.campus.create');
    }

    /**
     * Store a newly created resource in storage (AJAX).
     */
    public function store_ajax(Request $request)
    {

        try {
            // Validasi input
            $validated = $request->validate([
                'campus_name' => 'required|string|max:255|unique:campuses,campus_name',
            ], [
                'campus_name.required' => 'Nama campus wajib diisi',
                'campus_name.string' => 'Nama campus harus berupa teks',
                'campus_name.max' => 'Nama campus maksimal 255 karakter',
                'campus_name.unique' => 'Nama campus sudah ada, gunakan nama lain',
            ]);

            // Menggunakan database transaction untuk keamanan
            DB::beginTransaction();

            $campus = CampusModels::create($validated);

            DB::commit();

            return redirect()->route('campus.index')->with('success', 'Data campus berhasil disimpan');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Display the specified resource (AJAX) - untuk get data.
     */
    public function show(string $id)
    {
        try {
            $campus = CampusModels::findOrFail($id);

            return view('admin.campus.show', compact('campus'));
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data campus tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show detail data (AJAX) - untuk tampil modal detail.
     */
    public function show_detail_ajax(string $id)
    {
        try {
            $campus = CampusModels::findOrFail($id);
            return view('admin.campus.show_ajax', compact('campus'));
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data campus tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource (AJAX).
     */
    public function edit(string $id)
    {
        try {
            $campus = CampusModels::findOrFail($id);

            return view('admin.campus.edit', compact('campus'));
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data campus tidak ditemukan'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage (AJAX).
     */
    public function update_ajax(Request $request, string $id)
    {

        try {
            $campus = CampusModels::findOrFail($id);

            // Validasi input
            $validated = $request->validate([
                'campus_name' => 'required|string|max:255|unique:campuses,campus_name,' . $id,
            ], [
                'campus_name.required' => 'Nama campus wajib diisi',
                'campus_name.string' => 'Nama campus harus berupa teks',
                'campus_name.max' => 'Nama campus maksimal 255 karakter',
                'campus_name.unique' => 'Nama campus sudah ada, gunakan nama lain',
            ]);

            // Menggunakan database transaction
            DB::beginTransaction();

            $campus->update($validated);

            DB::commit();

            return redirect()->route('campus.index')->with('success', 'Data campus berhasil diperbarui');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage (AJAX).
     */
    public function destroy_ajax(string $id)
    {
        try {
            $campus = CampusModels::findOrFail($id);

            // Menggunakan database transaction
            DB::beginTransaction();

            $campus->delete(); // Soft delete jika model menggunakan SoftDeletes

            DB::commit();

            return redirect()->route('campus.index')->with('success', 'Data campus berhasil dihapus');
        } catch (Exception $e) {
            DB::rollBack();
            return view('admin.campus.index')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Display a listing of trashed resources.
     */
    public function trashed()
    {
        $breadcrumb = (object) [
            'title' => 'Data Campus Terhapus',
            'list' => ['Home', 'Campus', 'Trash']
        ];

        $page = (object) [
            'title' => 'Daftar campus yang telah dihapus'
        ];

        $activeMenu = 'campus';
        $campuses = CampusModels::onlyTrashed()->get();

        return view('admin.campus.trashed', compact('campuses', 'breadcrumb', 'page', 'activeMenu'));
    }

    /**
     * Restore the specified resource from trash (AJAX).
     */
    public function restore_ajax(string $id)
    {
        try {
            $campus = CampusModels::onlyTrashed()->findOrFail($id);

            DB::beginTransaction();

            $campus->restore();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data campus berhasil dipulihkan'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memulihkan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Permanently delete the specified resource (AJAX).
     */
    public function force_delete_ajax(string $id)
    {
        try {
            $campus = CampusModels::onlyTrashed()->findOrFail($id);

            DB::beginTransaction();

            $campus->forceDelete();

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Data campus berhasil dihapus permanen'
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get campus list for select options (AJAX).
     */
    public function get_campus_list()
    {
        try {
            $campuses = CampusModels::select('id', 'campus_name')
                ->orderBy('campus_name')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $campuses
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat mengambil data campus'
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserModels;
use App\Models\EducationalStaffModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEduStaffRequest;
use App\Http\Requests\UpdateEduStaffRequest;

class EduStaffController extends Controller
{
    public function index()
    {
        $educationalstaffs = EducationalStaffModels::all();
        return view('admin.educationalstaff.index', compact('educationalstaffs'));
    }

    // Store new Educational Staff with AJAX
    public function store_ajax(StoreEduStaffRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Create the user first
            $user = UserModels::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'educational_staff',
            ]);

            // Create the educational staff related to the user
            $staff = EducationalStaffModels::create([
                'user_id' => $user->id,
                'NIP' => $request->NIP,
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $staff,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }

    // Show staff details using AJAX
    public function show_ajax(string $id)
    {
        $staff = EducationalStaffModels::with('user')->findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $staff
        ]);
    }

    // Edit staff data with AJAX
    public function edit_ajax(string $id)
    {
        $staff = EducationalStaffModels::find($id);
        if ($staff) {
            return response()->json([
                'status' => true,
                'data' => $staff
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    // Update staff data with AJAX
    public function update_ajax(UpdateEduStaffRequest $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $staff = EducationalStaffModels::findOrFail($id);
            $staff->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $staff->update([
                'NIP' => $request->NIP,
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperbarui',
                'data' => $staff,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }

    // Soft delete staff data with AJAX
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $staff = EducationalStaffModels::findOrFail($id);
            if ($staff) {
                $staff->delete(); // Soft delete
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus (soft delete)'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }

    // Display trashed data with AJAX
    public function trashed()
    {
        $staffs = EducationalStaffModels::onlyTrashed()->with('user')->get();
        return response()->json([
            'status' => true,
            'data' => $staffs
        ]);
    }

    // Restore trashed staff data with AJAX
    public function restore(string $id)
    {
        $staff = EducationalStaffModels::onlyTrashed()->findOrFail($id);
        $staff->restore();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dipulihkan',
        ]);
    }

    // Permanently delete trashed staff data with AJAX
    public function forceDelete(string $id)
    {
        $staff = EducationalStaffModels::onlyTrashed()->findOrFail($id);
        $staff->forceDelete();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil dihapus permanen',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserModels;
use App\Models\AdminModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    // List semua admin (termasuk relasi user)
    public function index()
    {
        $admins = AdminModels::with('user')->get();

        return response()->json([
            'status' => true,
            'data' => $admins
        ]);
    }

    // Detail satu admin
    public function show_ajax(string $id)
    {
        $admin = AdminModels::with('user')->findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $admin
        ]);
    }

    public function edit_ajax(string $id)
    {
        $admin = AdminModels::find($id);
        if ($admin) {
            return response()->json([
                'status' => true,
                'data' => $admin
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }

    // Create admin baru (buat record user + admin)
    public function store_ajax(StoreAdminRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Create the user first
            $user = UserModels::create([
                'name' => $request->admin_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'admin',
            ]);

            // Create the admin record
            $admin = AdminModels::create([
                'user_id' => $user->id,
                'admin_name' => $request->admin_name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Admin berhasil ditambahkan',
                'data' => $admin->load('user'),
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }


    // Update data admin
    public function update_ajax(UpdateAdminRequest $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $admin = AdminModels::findOrFail($id);
            $admin->user->update([
                'name' => $request->admin_name,
                'email' => $request->email,
            ]);
            $admin->update([
                'admin_name' => $request->admin_name,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Admin berhasil diperbarui',
                'data' => $admin->load('user'),
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Request tidak valid'
        ]);
    }


    // Soft delete
    public function delete_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $admin = AdminModels::findOrFail($id);
            if ($admin) {
                // Soft delete
                $admin->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Admin berhasil dihapus (soft delete)'
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


    // List yang sudah ter‐soft delete
    public function trashed()
    {
        $admins = AdminModels::onlyTrashed()->with('user')->get();

        return response()->json([
            'status' => true,
            'data' => $admins
        ]);
    }

    // Restore dari soft delete
    public function restore(string $id)
    {
        $admin = AdminModels::onlyTrashed()->findOrFail($id);
        $admin->restore();

        return response()->json([
            'status' => true,
            'message' => 'Admin berhasil dipulihkan',
        ]);
    }

    // Hapus permanen
    public function forceDelete(string $id)
    {
        $admin = AdminModels::onlyTrashed()->findOrFail($id);
        $admin->forceDelete();

        return response()->json([
            'status' => true,
            'message' => 'Admin berhasil dihapus permanen',
        ]);
    }
}

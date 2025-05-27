<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserModels;
use App\Models\AdminModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // List semua admin (termasuk relasi user)
    public function index()
    {
        $admins = AdminModels::with('user')->get();

        return response()->json([
            'status' => true,
            'data'   => $admins
        ]);
    }

    // Detail satu admin
    public function show(string $id)
    {
        $admin = AdminModels::with('user')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data'   => $admin
        ]);
    }

    // Create admin baru (buat record user + admin)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_name' => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors(),
                'message' => 'Validasi gagal',
            ], 422);
        }

        // Buat user
        $user = UserModels::create([
            'name'     => $request->admin_name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'admin',
        ]);

        // Buat admin record
        $admin = AdminModels::create([
            'user_id'    => $user->id,
            'admin_name' => $request->admin_name,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Admin berhasil ditambahkan',
            'data'    => $admin->load('user'),
        ], 201);
    }

    // Update data admin
    public function update(Request $request, string $id)
    {
        $admin = AdminModels::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'admin_name' => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,'.$admin->user_id,
            'password'   => 'nullable|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors(),
                'message' => 'Validasi gagal',
            ], 422);
        }

        // Update user
        $dataUser = [
            'name'  => $request->admin_name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $dataUser['password'] = bcrypt($request->password);
        }
        $admin->user->update($dataUser);

        // Update admin record
        $admin->update([
            'admin_name' => $request->admin_name,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Admin berhasil diperbarui',
            'data'    => $admin->load('user'),
        ]);
    }

    // Soft delete
    public function destroy(string $id)
    {
        $admin = AdminModels::findOrFail($id);
        $admin->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Admin berhasil dihapus (soft delete)',
        ]);
    }

    // List yang sudah ter‐soft delete
    public function trashed()
    {
        $admins = AdminModels::onlyTrashed()->with('user')->get();

        return response()->json([
            'status' => true,
            'data'   => $admins
        ]);
    }

    // Restore dari soft delete
    public function restore(string $id)
    {
        $admin = AdminModels::onlyTrashed()->findOrFail($id);
        $admin->restore();

        return response()->json([
            'status'  => true,
            'message' => 'Admin berhasil dipulihkan',
        ]);
    }

    // Hapus permanen
    public function forceDelete(string $id)
    {
        $admin = AdminModels::onlyTrashed()->findOrFail($id);
        $admin->forceDelete();

        return response()->json([
            'status'  => true,
            'message' => 'Admin berhasil dihapus permanen',
        ]);
    }
}

<?php

namespace app\Http\Controllers\Admin;

use app\Models\UserModels;
use app\Models\AdminModels;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use app\Http\Requests\StoreAdminRequest;
use app\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Hash;
use Exception;

class AdminController extends Controller
{
    // List semua admin (termasuk relasi user)
    public function index()
    {
        $admins = AdminModels::with('user')->get();

        return view('admin.admin.index', ['admins' => $admins]);
    }

    //profile admin
    public function profile()
    {
        $admin = AdminModels::with('user')->where('user_id', auth()->id())->firstOrFail();
        return view('admin.profile', ['admin' => $admin]);
    }

    // Detail satu admin
    public function show(string $id)
    {
        try {
            $admin = AdminModels::with('user')->findOrFail($id);
            return view('admin.admin.show', compact('admin'));
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Data admin tidak ditemukan'
            ]);
        }
    }

    public function edit(string $id)
    {
        try {
            $admin = AdminModels::with('user')->findOrFail($id);
            return view('admin.admin.edit', compact('admin'));
        } catch (Exception $e) {
            return redirect()->back()->with([
                'status' => false,
                'message' => 'Data admin tidak ditemukan'
            ]);
        }
    }

    // view create admin
    public function create()
    {
        return view('admin.admin.create');
    }
    // Store a new admin into the database
    public function store(StoreAdminRequest $request)
    {
        // Validasi permintaan
        $validatedData = $request->validated();

        // Set role_id secara manual
        $validatedData['role_id'] = 1;

        // Log data yang akan dimasukkan
        \Log::info('Data yang dikirim untuk user:', $validatedData);

        // Membuat user baru (admin)
        $user = UserModels::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 1,  // Role admin
        ]);

        // Log setelah user dibuat
        \Log::info('User yang dibuat:', $user->toArray());

        // Membuat entri admin
        $admin = AdminModels::create([
            'user_id' => $user->id,
        ]);

        // Log admin yang baru dibuat
        \Log::info('Admin yang dibuat:', $admin->toArray());

        // Redirect ke halaman index admin
        return redirect()->route('admin.index')->with('success', 'Admin berhasil dibuat!');
    }



    // Update data admin
    public function update(UpdateAdminRequest $request, string $id)
    {
        // Find the admin by ID or fail with a 404 error
        $admin = AdminModels::findOrFail($id);

        // Update user data (name, email)
        $admin->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update admin data and handle password update if provided
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->filled('password')
                ? Hash::make($request->password)
                : $admin->user->password, // Retain the existing password if not updated
        ]);

        // Redirect with success message
        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui!');
    }



    // Soft delete
    public function delete_ajax(Request $request, string $id)
    {
        try {
            $admin = AdminModels::findOrFail($id);
            $admin->delete();
            return redirect()->route('admin.index')->with('success', 'Admin berhasil dihapus!');

        } catch (Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Terjadi kesalahan saat menghapus admin: ' . $e->getMessage());
        }

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

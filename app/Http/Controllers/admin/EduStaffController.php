<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserModels;
use App\Models\EducationalStaffModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class EduStaffController extends Controller
{
    public function index()
    {
        $staffs = EducationalStaffModels::with('user')->get();

        return response()->json([
            'status' => true,
            'data'   => $staffs
        ]);
    }

    public function show(string $id)
    {
        $staff = EducationalStaffModels::with('user')->findOrFail($id);

        return response()->json([
            'status' => true,
            'data'   => $staff
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'NIP'      => 'required|string|unique:educational_staff,NIP',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors(),
                'message' => 'Validasi gagal',
            ], 422);
        }

        $user = UserModels::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'educational_staff',
        ]);

        $staff = EducationalStaffModels::create([
            'user_id' => $user->id,
            'NIP'     => $request->NIP,
            'name'    => $request->name,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil ditambahkan',
            'data'    => $staff,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $staff = EducationalStaffModels::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $staff->user_id,
            'NIP'   => 'required|string|unique:educational_staff,NIP,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'errors'  => $validator->errors(),
                'message' => 'Validasi gagal',
            ], 422);
        }

        $staff->user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        $staff->update([
            'NIP'  => $request->NIP,
            'name' => $request->name,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil diperbarui',
            'data'    => $staff,
        ]);
    }

    public function destroy(string $id)
    {
        $staff = EducationalStaffModels::findOrFail($id);
        $staff->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil dihapus (soft delete)',
        ]);
    }

    public function trashed()
    {
        $staffs = EducationalStaffModels::onlyTrashed()->with('user')->get();

        return response()->json([
            'status' => true,
            'data'   => $staffs
        ]);
    }

    public function restore(string $id)
    {
        $staff = EducationalStaffModels::onlyTrashed()->findOrFail($id);
        $staff->restore();

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil dipulihkan',
        ]);
    }

    public function forceDelete(string $id)
    {
        $staff = EducationalStaffModels::onlyTrashed()->findOrFail($id);
        $staff->forceDelete();

        return response()->json([
            'status'  => true,
            'message' => 'Data berhasil dihapus permanen',
        ]);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\MajorModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    public function index()
    {
        $major = MajorModels::all();
        return response()->json([
            'status' => true,
            'data' => $major
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'major_name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $major = MajorModels::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Major created successfully',
            'data' => $major
        ]);
    }

    public function show($id)
    {
        $major = MajorModels::find($id);
        if (!$major) {
            return response()->json([
                'status' => false,
                'message' => 'Major not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $major
        ]);
    }

    public function update(Request $request, $id)
    {
        $major = MajorModels::find($id);
        if (!$major) {
            return response()->json([
                'status' => false,
                'message' => 'Major not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'major_name' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $major->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Major updated successfully',
            'data' => $major
        ]);
    }

    public function destroy($id)
    {
        $major = MajorModels::find($id);
        if (!$major) {
            return response()->json([
                'status' => false,
                'message' => 'Major not found'
            ], 404);
        }

        try {
            $major->delete();
            return response()->json([
                'status' => true,
                'message' => 'Major deleted successfully'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete major because it is related to another table'
            ], 409);
        }
    }
}
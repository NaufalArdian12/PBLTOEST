<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToeicTestModels;
use Illuminate\Support\Facades\Validator;

class ToeicTestController extends Controller
{
    // Get all TOEIC test records
    public function index()
    {
        $data = ToeicTestModels::all();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Create a new TOEIC test record
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'toeic_test_name' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = ToeicTestModels::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data successfully saved.',
            'data' => $data
        ], 201);
    }

    // Show a specific TOEIC test record
    public function show($id)
    {
        $data = ToeicTestModels::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found.'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Update an existing TOEIC test record
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'toeic_test_name' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed.',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = ToeicTestModels::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found.'
            ], 404);
        }

        $data->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Data successfully updated.',
            'data' => $data
        ]);
    }

    // Delete a TOEIC test record
    public function destroy($id)
    {
        $data = ToeicTestModels::find($id);

        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data not found.'
            ], 404);
        }

        try {
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data successfully deleted.'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Cannot delete this record because it is linked to another table.'
            ], 400);
        }
    }
}

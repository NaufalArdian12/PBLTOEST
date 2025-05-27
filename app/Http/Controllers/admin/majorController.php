<?php

namespace App\Http\Controllers\admin;

use App\Models\MajorModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    public function index()
    {
        $major = MajorModels::with(relations: 'campus')->get();

        return response()->json([
            'status' => true,
            'data'   => $major
        ], 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'campus_id' => 'required|exists:campuses,id',
            'major_name' => 'required|string|max:100'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed validation',
                'errors'  => $validator->errors()
            ], 422);
        }

        $major = MajorModels::create([
            'campus_id' => $request->campus_id,
            'major_name' => $request->major_name
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Data created successfully',
            'data'    => [
                'id'          => $major->id,
                'campus_id'   => $major->campus_id,
                'major_name'  => $major->major_name,
                'created_at'  => $major->created_at,
                'updated_at'  => $major->updated_at
            ]
        ], 201);
    }

public function list()
{
    $major = MajorModels::with('campus')
        ->select('id', 'major_name', 'campus_id');

    return DataTables::of($major)
        ->addIndexColumn()
        ->addColumn('campus', function ($major) {
            return $major->campus->campus_name ?? '-';
        })
        ->addColumn('action', function ($major) {
            $btn  = '<button onclick="modalAction(\'' . url('/major/' . $major->id . '/show') . '\')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm mr-1">Detail</button>';
            $btn .= '<button onclick="modalAction(\'' . url('/major/' . $major->id . '/edit') . '\')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-1">Edit</button>';
            $btn .= '<button onclick="modalAction(\'' . url('/major/' . $major->id . '/confirm') . '\')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
}

    public function show(string $id)
    {
        $major = MajorModels::with('campus')->find($id);

        if (!$major) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => $major
        ]);
    }

    public function edit(string $id)
    {
        return $this->show($id); // sama dengan show
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'campus_id' => 'required|exists:campuses,id',
            'major_name'       => 'required|string|max:100'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Failed validation',
                'msgField' => $validator->errors()
            ], 422);
        }

        $major = MajorModels::find($id);

        if (!$major) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found'
            ], 404);
        }

        $major->update([
            'campus_id' => $request->campus_id,
            'major_name'       => $request->major_name
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Data updated successfully',
            'data'    => $major
        ]);
    }

    public function confirm(string $id)
    {
        $major = MajorModels::find($id);

        if (!$major) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Are you sure you want to delete this data?',
            'data'    => $major
        ]);
    }

    public function destroy($id)
    {
        $major = MajorModels::find($id);

        if (!$major) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found'
            ], 404);
        }

        $major->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Data successfully soft deleted'
        ]);
    }

    public function trashed()
    {
        $trashed = MajorModels::onlyTrashed()->with('campus')->get();

        return response()->json([
            'status' => true,
            'data'   => $trashed
        ]);
    }

    public function restore($id)
    {
        $major = MajorModels::onlyTrashed()->find($id);

        if (!$major) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found in trash'
            ], 404);
        }

        $major->restore();

        return response()->json([
            'status'  => true,
            'message' => 'Data successfully restored'
        ]);
    }

    public function forceDelete($id)
    {
        $major = MajorModels::onlyTrashed()->find($id);

        if (!$major) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found in trash'
            ], 404);
        }

        $major->forceDelete();

        return response()->json([
            'status'  => true,
            'message' => 'Data permanently deleted'
        ]);
    }
}
<?php

namespace App\Http\Controllers\admin;

use App\Models\CampusModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class CampusController extends Controller
{
        public function index()
    {
        $campus = CampusModels::all();

        return response()->json([
            'status' => true,
            'data'   => $campus
        ], 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'campus_name' => 'required|string|max:100'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed validation',
                'errors'  => $validator->errors()
            ], 422);
        }

        $campus = CampusModels::create($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Data created successfully',
            'data'    => $campus
        ], 201);
    }

    public function list()
    {
        $campus = CampusModels::select('id', 'campus_name');

        return DataTables::of($campus)
            ->addIndexColumn()
            ->addColumn('action', function ($campus) {
                $btn  = '<button onclick="modalAction(\'' . url('/campus/' . $campus->id . '/show') . '\')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm mr-1">Detail</button>';
                $btn .= '<button onclick="modalAction(\'' . url('/campus/' . $campus->id . '/edit') . '\')" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm mr-1">Edit</button>';
                $btn .= '<button onclick="modalAction(\'' . url('/campus/' . $campus->id . '/confirm') . '\')" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(string $id)
    {
        $campus = CampusModels::find($id);

        if (!$campus) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data'   => $campus
        ]);
    }

    public function edit(string $id)
    {
        return $this->show($id); // sama dengan show
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'campus_name' => 'required|string|max:100'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Failed validation',
                'msgField' => $validator->errors()
            ], 422);
        }

        $campus = CampusModels::find($id);

        if (!$campus) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found'
            ], 404);
        }

        $campus->update($request->all());

        return response()->json([
            'status'  => true,
            'message' => 'Data updated successfully',
            'data'    => $campus
        ]);
    }

    public function confirm(string $id)
    {
        $campus = CampusModels::find($id);

        if (!$campus) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found'
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Are you sure you want to delete this data?',
            'data'    => $campus
        ]);
    }

    // Soft delete
    public function destroy($id)
    {
        $campus = CampusModels::find($id);

        if (!$campus) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found'
            ], 404);
        }

        $campus->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Data successfully soft deleted'
        ]);
    }

    // Menampilkan data yang sudah di-soft delete
    public function trashed()
    {
        $trashed = CampusModels::onlyTrashed()->get();

        return response()->json([
            'status' => true,
            'data'   => $trashed
        ]);
    }

    // Mengembalikan data yang di-soft delete
    public function restore($id)
    {
        $campus = CampusModels::onlyTrashed()->find($id);

        if (!$campus) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found in trash'
            ], 404);
        }

        $campus->restore();

        return response()->json([
            'status'  => true,
            'message' => 'Data successfully restored'
        ]);
    }

    // Menghapus secara permanen
    public function forceDelete($id)
    {
        $campus = CampusModels::onlyTrashed()->find($id);

        if (!$campus) {
            return response()->json([
                'status'  => false,
                'message' => 'Data not found in trash'
            ], 404);
        }

        $campus->forceDelete();

        return response()->json([
            'status'  => true,
            'message' => 'Data permanently deleted'
        ]);
    }
}

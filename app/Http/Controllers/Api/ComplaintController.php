<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // READ ALL: Ambil semua data aduan
    public function index()
    {
        $complaints = Complaint::with(['user', 'complaintType'])->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $complaints
        ], 200);
    }

    // CREATE: Simpan aduan baru
    public function store(Request $request)
    {
        $request->validate([
            'complaint_type_id' => 'required|exists:complaint_types,id',
            'description' => 'required|string',
            'priority' => 'required|in:high,medium,low',
        ]);

        $complaint = Complaint::create([
            'user_id' => $request->user()->id,
            'complaint_type_id' => $request->complaint_type_id,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);

        return response()->json([
            'message' => 'Complaint submitted successfully!',
            'data' => $complaint->load(['user', 'complaintType'])
        ], 201);
    }

    // READ SINGLE: Ambil 1 detail aduan berdasarkan ID
    public function show($id)
    {
        $complaint = Complaint::with(['user', 'complaintType'])->find($id);

        if (!$complaint) {
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $complaint
        ], 200);
    }

    // UPDATE: Ubah/edit data aduan
    public function update(Request $request, $id)
    {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        $request->validate([
            'complaint_type_id' => 'sometimes|required|exists:complaint_types,id',
            'description' => 'sometimes|required|string',
            'priority' => 'sometimes|required|in:high,medium,low',
            'status' => 'sometimes|required|in:pending,in_progress,resolved,rejected',
        ]);

        $complaint->update($request->only([
            'complaint_type_id', 
            'description', 
            'priority', 
            'status'
        ]));

        return response()->json([
            'message' => 'Complaint updated successfully!',
            'data' => $complaint->load(['user', 'complaintType'])
        ], 200);
    }

    // DELETE: Hapus aduan
    public function destroy($id)
    {
        $complaint = Complaint::find($id);

        if (!$complaint) {
            return response()->json(['message' => 'Complaint not found'], 404);
        }

        $complaint->delete();

        return response()->json([
            'message' => 'Complaint deleted successfully!'
        ], 200);
    }
}
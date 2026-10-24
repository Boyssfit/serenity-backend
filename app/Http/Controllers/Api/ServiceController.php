<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->get();
        return response()->json(['data' => $services]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:150',
                'category_id' => 'required',
                'harga' => 'required|numeric',
                'durasi' => 'required|string',
                'deskripsi' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $fotoUrl = null;
            if ($request->hasFile('foto')) {
                $path = $request->file('foto')->store('services', 'public');
                $fotoUrl = asset('storage/' . $path);
            }

            $service = Service::create([
                'nama' => $request->nama,
                'category_id' => $request->category_id,
                'harga' => $request->harga,
                'durasi' => $request->durasi,
                'deskripsi' => $request->deskripsi,
                'foto_url' => $fotoUrl,
            ]);

            return response()->json([
                'message' => 'Layanan berhasil ditambahkan',
                'data' => $service
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $service = Service::findOrFail($id);

            $request->validate([
                'nama' => 'required|string|max:150',
                'category_id' => 'required',
                'harga' => 'required|numeric',
                'durasi' => 'required|string',
                'deskripsi' => 'nullable|string',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                if ($service->foto_url) {
                    $oldPath = str_replace(asset('storage/'), '', $service->foto_url);
                    Storage::disk('public')->delete($oldPath);
                }
                $path = $request->file('foto')->store('services', 'public');
                $service->foto_url = asset('storage/' . $path);
            }

            $service->nama = $request->nama;
            $service->category_id = $request->category_id;
            $service->harga = $request->harga;
            $service->durasi = $request->durasi;
            $service->deskripsi = $request->deskripsi;
            $service->save();

            return response()->json([
                'message' => 'Layanan berhasil diperbarui',
                'data' => $service
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        if ($service) {
            if ($service->foto_url) {
                $oldPath = str_replace(asset('storage/'), '', $service->foto_url);
                Storage::disk('public')->delete($oldPath);
            }
            $service->delete();
            return response()->json(['message' => 'Layanan berhasil dihapus']);
        }
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
}
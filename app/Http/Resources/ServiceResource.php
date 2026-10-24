<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id_service,
            'nama' => $this->nama,
            'harga' => (float) $this->harga,
            'durasi' => $this->durasi,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status,
            'foto_url' => $this->foto ? url('storage/' . $this->foto) : null,
            'kategori' => [
                'id' => $this->id_category,
                'nama' => $this->category?->nama_kategori,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
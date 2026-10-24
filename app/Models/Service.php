<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Arahkan ke nama tabel 'services' yang ada di MySQL
    protected $table = 'services';

    protected $fillable = [
        'category_id',
        'nama',
        'deskripsi',
        'harga',
        'durasi',
        'foto_url',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
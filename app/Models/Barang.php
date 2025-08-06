<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';

    protected $fillable = [
        'category_id',
        'nama_barang',
        'kode_barang',
        'jumlah',
        'kondisi',
        'deskripsi',
        'foto', // Tambahkan kolom foto ke dalam fillable
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }

}

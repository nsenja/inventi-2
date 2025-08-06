<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';
    protected $fillable = ['barang_id', 'jumlah', 'tanggal_masuk', 'catatan','bukti',
];

    public function barang() {
        return $this->belongsTo(Barang::class);
    }
    public function kategori() {
        return $this->barang->kategori();
    }
    
    
}

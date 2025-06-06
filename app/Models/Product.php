<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_product';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_product',
        'id_umkm',
        'id_kategori',
        'nama_produk',
        'harga',
        'stock',
        'deskripsi',
        'foto',
        'created_at',
        'updated_at',
    ];

    public function umkmProfile()
    {
        return $this->belongsTo(UMKMProfile::class, 'id_umkm', 'id_umkm');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }
}

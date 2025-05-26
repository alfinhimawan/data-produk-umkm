<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKMProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_users',
        'nama_umkm',
        'alamat',
        'kontak',
        'status',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_umkm', 'id_umkm');
    }
}

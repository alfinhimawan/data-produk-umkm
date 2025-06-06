<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKMProfile extends Model
{
    use HasFactory;
    protected $table = 'umkm_profiles';
    protected $primaryKey = 'id_umkm';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_users',
        'nama_umkm',
        'alamat',
        'kontak',
        'logo',
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

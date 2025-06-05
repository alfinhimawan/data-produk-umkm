<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'id_users', 'action', 'target_table', 'target_id', 'before', 'after'
    ];
    protected $casts = [
        'before' => 'array',
        'after' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}

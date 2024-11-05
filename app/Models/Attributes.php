<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasUuid;

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    public $incrementing = false;   // Menonaktifkan auto-increment
    public $timestamps = false;
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'attributes';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'name',
        'uuid',
        'is_active',
        'is_deleted',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}

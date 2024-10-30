<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;   // Menonaktifkan auto-increment
    public $timestamps = false;
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'product_image';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'product_id',
        'image',
        'ext',
        'size',
        'is_active',
        'is_deleted',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

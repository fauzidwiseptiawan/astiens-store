<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    use HasFactory, HasUuid;

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    public $incrementing = false;   // Menonaktifkan auto-increment
    public $timestamps = false;
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'flash_sale';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'name',
        'slug',
        'start_date',
        'end_date',
        'image',
        'ext',
        'size',
        'is_active',
        'is_feature',
        'is_deleted',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function flashSaleProduct()
    {
        return $this->hasMany(FlashSaleProduct::class, 'flash_sale_id');
    }
}

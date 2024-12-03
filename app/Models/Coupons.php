<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory, HasUuid;

    protected static function booted()
    {
        static::addGlobalScope(new ActiveScope);
    }

    public $incrementing = false;   // Menonaktifkan auto-increment
    public $timestamps = false;
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'coupons';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'code',
        'type_coupon',
        'type',
        'discount_amount',
        'min_purchase',
        'max_discount',
        'start_date',
        'start_date',
        'end_date',
        'usage_limit',
        'is_deleted',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];
}

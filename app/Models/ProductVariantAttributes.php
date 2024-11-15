<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantAttributes extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;   // Menonaktifkan auto-increment
    public $timestamps = true;
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'product_variant_attributes';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $fillable = [
        'product_variant_id ',
        'attributes_value_id ',
    ];
}

<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashSaleProduct extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;   // Menonaktifkan auto-increment
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'flash_sale_product';

    protected $fillable = [
        'flash_sale_id',
        'product_id',
        'discount_price',
        'discount_type'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

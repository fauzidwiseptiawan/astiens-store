<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;   // Menonaktifkan auto-increment
    public $timestamps = false;
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'product';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];
    protected $fillable = [
        'item_code',
        'categories_id',
        'sub_categories_id',
        'brand_id',
        'name',
        'slugs',
        'unit',
        'min_qty',
        'max_qty',
        'barcode',
        'image',
        'ext',
        'size',
        'price',
        'sku',
        'stock',
        'date',
        'discount_start_date',
        'discount_end_date',
        'discount',
        'short_desc',
        'long_desc',
        'tags',
        'seo',
        'seo_desc',
        'new_arrival',
        'best_seller',
        'special_offer',
        'hot',
        'new',
        'sale',
        'is_active',
        'is_deleted',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by',
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}

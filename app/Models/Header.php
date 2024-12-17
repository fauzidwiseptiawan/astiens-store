<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Header extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;   // Menonaktifkan auto-increment
    public $timestamps = false;
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'headers';

    protected $fillable = [
        'title_promo',
        'image',
        'ext',
        'size',
        'nav_menu',
    ];

    protected $casts = [
        'title_promo' => 'array', // Agar kolom JSON otomatis di-cast menjadi array
        'nav_menu' => 'array', // Agar kolom JSON otomatis di-cast menjadi array
    ];
}

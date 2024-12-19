<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footer extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;   // Menonaktifkan auto-increment
    public $timestamps = false;
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'footers';

    protected $fillable = [
        'address',
        'phone',
        'show_link',
        'email',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'pinterest',
        'show_store',
        'app_store',
        'play_store',
        'image1',
        'ext1',
        'size1',
        'image2',
        'ext12',
        'size12',
    ];

    protected $casts = [
        'link_menu' => 'array', // Agar kolom JSON otomatis di-cast menjadi array
    ];
}

<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderGroups extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;   // Menonaktifkan auto-increment
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'slider_groups';


    protected $fillable = [
        'name',
    ];

    public function sliderItems()
    {
        return $this->hasMany(SliderItems::class);
    }
}

<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderItems extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;   // Menonaktifkan auto-increment
    protected $keyType = 'string'; // Mengubah tipe kunci menjadi string
    protected $table = 'slider_items';

    protected $fillable = [
        'slider_groups_id',
        'title_h4',
        'subtitle_h2',
        'main_heading_h1',
        'description_p',
        'link_url',
        'order',
        'status',
        'image',
        'ext',
        'size',
    ];

    public function sliderGroup()
    {
        return $this->belongsTo(SliderGroups::class);
    }
}

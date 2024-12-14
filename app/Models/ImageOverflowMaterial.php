<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ImageOverflowMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'overflow_material_id', 'image'
    ];

    protected $appends = ['image_url'];

    protected $hidden = ['image'];


    public $timestamps = false;

    public function material(): BelongsTo
    {
        return $this->belongsTo(OverflowMaterial::class)->withDefault();
    }

    public function getImageUrlAttribute()
    {
        // column image in database
        if (!$this->image) {
            return "https://aui.atlassian.com/aui/8.8/docs/images/avatar-person.svg";
        }

        // if $this->image start with http:// or https://
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return asset('material/' . $this->image);
    }
}

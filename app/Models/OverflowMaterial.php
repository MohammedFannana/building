<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OverflowMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'material', 'quantity', 'description'
    ];

    protected $hidden = ['image'];



    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function images(): HasMany
    {
        return $this->hasMany(ImageOverflowMaterial::class);
    }
}

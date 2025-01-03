<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Area extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}

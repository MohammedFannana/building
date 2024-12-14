<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'service_id',
        'user_type',
        'type',
        'commercial_register',
        'career_id',
        'area_id',
        'city_id',
        'agree_condition',
        'image',
        'experience_year',
        'status',
        'is_subscribed',
        'subscription_end_data',
    ];

    protected $appends = ['image_url'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'agree_condition',
        'user_type',
        'created_at',
        'updated_at',
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('status', '=', 'نشط');
    }


    public function materials()
    {
        return $this->hasMany(OverflowMaterial::class);
    }


    public function service()
    {
        return $this->belongsTo(Service::class)->withDefault();
    }

    public function area()
    {
        return $this->belongsTo(Area::class)->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }

    public function career($id)
    {

        $career = DB::table('users')
            ->join('careers', 'users.career_id', '=', 'careers.id')
            ->where('users.id', '=', $id)
            ->select(['*'])
            ->first();

        return $career;
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

        return asset('storage/' . $this->image);
    }
}

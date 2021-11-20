<?php

namespace App\Models;

use App\Models\City;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Scopes\ActiveScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable, IsTrashed, ActiveScope, SoftDeletes;

   
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
        'active',
        'gender',
        'phone',
        'city_id',
        'age',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'avatar' => 'users/default.jpg'
    ];

    protected $appends  = ['gen'];

    public function getGenAttribute()
    {
        return $this->gender == 'm' ? 'Male' : 'Female';
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

<?php

namespace App\Models;

use App\Traits\Scopes\ActiveScope;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable, IsTrashed, ActiveScope, SoftDeletes;

   
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'gender',
        'phone',
        'city_id',
        'age'
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

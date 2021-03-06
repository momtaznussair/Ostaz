<?php

namespace App\Models;

use App\Models\City;
use App\Models\Course;
use App\Notifications\UserResetPassword;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\TypeScope;
use App\Traits\Scopes\Searchable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\Scopes\ActiveScope;
use App\Traits\Scopes\CountryScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable implements CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable, Searchable, IsTrashed, ActiveScope, 
    SoftDeletes, CountryScope, SoftCascadeTrait, TypeScope, CanResetPassword;

   
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
    * returns filters that can be applied to this model by getAll() method in Repository
    * ckeck App\Repositories\SQL\Repository
    */
    public static  function filters() {
        return ['isActive', 'isTrashed', 'Search', 'country', 'type'];
    }

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

    /**
     * The relations that should be soft deleted when this gets soft deleted.
     *
     * @var array
     */
    protected $softCascade = ['courses'];


    protected $appends  = ['gen'];

    public function getGenAttribute()
    {
        return $this->gender == 'm' ? 'Male' : 'Female';
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // courses of user of type instructor
    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id');
    }

    public function studentCourses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }

    public function sendPasswordResetNotification($token)
    {
        $url = route('reset-password', $token);
        $this->notify(new UserResetPassword($url));
    }

    public function getAvatarPathAttribute() {
        return !is_null($this->avatar) ? asset('storage/' . $this->avatar) : asset('storage/users/default.jpg');
    }

}

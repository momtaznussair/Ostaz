<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminResetPassword;
use App\Traits\Scopes\ActiveScope;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword as PasswordsCanResetPassword;

class Admin extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable, HasRoles, PasswordsCanResetPassword,  SoftDeletes, Searchable, IsTrashed, ActiveScope;

    protected $fillable = [
        'password',
        'avatar',
        'name',
        'email',
        'phone',
        'active'
    ];

    /**
     * returns filters that can be applied to this model by getAll() method in Repository
     * ckeck App\Repositories\SQL\Repository
     */
    public static  function filters() {
        return ['isActive', 'isTrashed', 'Search'];
    }
    
    public function sendPasswordResetNotification($token) {
        $this->notify(new AdminResetPassword($token));
    }

    public function getAvatarPathAttribute() {
        return !is_null($this->avatar) ? asset('storage/' . $this->avatar) : asset('storage/admins/default.jpg');
    }
}

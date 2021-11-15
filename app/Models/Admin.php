<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword as PasswordsCanResetPassword;

class Admin extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable, HasRoles, PasswordsCanResetPassword,  SoftDeletes;

    protected $fillable = [
        'password',
        'avatar',
        'name',
        'email',
        'phone',
        'active'
    ];

    protected $attributes = [
        'avatar' => 'admins/default.jpg',
        'active' => true
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPassword($token));
    }
}

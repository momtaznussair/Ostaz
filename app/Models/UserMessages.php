<?php

namespace App\Models;

use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMessages extends Model
{
    use HasFactory, SoftDeletes, Searchable, IsTrashed;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'type'
    ];
}

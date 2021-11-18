<?php

namespace App\Models;

use App\Traits\Scopes\ActiveScope;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory, Searchable, IsTrashed, ActiveScope, SoftDeletes;

    protected $fillable = [
        'name',
        'active'
    ];


    public function cities()
    {
        return $this->hasMany(City::class);
    }
}

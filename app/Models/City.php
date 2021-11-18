<?php

namespace App\Models;

use App\Traits\Scopes\ActiveScope;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, Searchable, IsTrashed, ActiveScope, SoftDeletes;

    protected $fillable = [
        'name',
        'country_id',
        'active'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

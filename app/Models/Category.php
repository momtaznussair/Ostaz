<?php

namespace App\Models;

use App\Traits\Scopes\ActiveScope;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, Searchable, SoftDeletes, IsTrashed, ActiveScope;

    protected $fillable = [
        'active',
        'name'
    ];

    protected $attributes = [
        'active' => true
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

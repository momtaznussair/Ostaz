<?php

namespace App\Models;

use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use App\Traits\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Searchable, SoftDeletes, IsTrashed, ActiveScope, SoftCascadeTrait;

    protected $fillable = [
        'active',
        'name'
    ];

    protected $attributes = [
        'active' => true
    ];

    protected $softCascade = ['courses'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

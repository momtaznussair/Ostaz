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

    /**
     * returns filters that can be applied to this model by getAll() method in Repository
     * ckeck App\Repositories\SQL\Repository
     */
    public static  function filters() {
        return ['isActive', 'isTrashed', 'Search'];
    }

    protected $appends = ['instructors'];


    protected $softCascade = ['courses'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function getInstructorsAttribute()
    {
        return User::whereIn('id', $this->courses->pluck('instructor_id'));

    }
}

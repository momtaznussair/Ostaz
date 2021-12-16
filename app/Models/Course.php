<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use App\Traits\Scopes\ActiveScope;
use App\Traits\Scopes\CategoryScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, Searchable, SoftDeletes, IsTrashed, ActiveScope, CategoryScope;

    protected $fillable = [
        'name',
        'active',
        'category_id'
    ];

    public static  function filters() {
        return ['isActive', 'isTrashed', 'Search', 'category'];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function student()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}

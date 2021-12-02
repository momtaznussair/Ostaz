<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use App\Traits\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, Searchable, SoftDeletes, IsTrashed, ActiveScope;

    protected $fillable = [
        'name',
        'active',
        'category_id'
    ];

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

    public function ScopeCategory($query, $category)
    {
       if($category){
        return $query->whereHas('city', function (Builder $query) use ($category) {
            $query->where('category_id', $category);
        });
       }
    }
}

<?php

namespace App\Models;

use App\Traits\Scopes\ActiveScope;
use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
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
}

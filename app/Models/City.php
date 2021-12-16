<?php

namespace App\Models;

use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use App\Traits\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, Searchable, IsTrashed, ActiveScope, SoftDeletes, SoftCascadeTrait;

    protected $fillable = [
        'name',
        'country_id',
        'active'
    ];

    public static  function filters() {
        return ['isActive', 'isTrashed', 'Search'];
    }

     /**
     * The relations that should be soft deleted when this gets soft deleted.
     *
     * @var array
     */
    protected $softCascade = ['users'];


    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function users()
    {
       return $this->hasMany(User::class);
    }
}

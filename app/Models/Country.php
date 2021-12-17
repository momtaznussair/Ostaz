<?php

namespace App\Models;

use App\Traits\Scopes\IsTrashed;
use App\Traits\Scopes\Searchable;
use App\Traits\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory, Searchable, IsTrashed, ActiveScope, SoftDeletes, SoftCascadeTrait;

    protected $fillable = [
        'name',
        'active'
    ];

    /**
    * returns filters that can be applied to this model by getAll() method in Repository
    * ckeck App\Repositories\SQL\Repository
    */
    public static  function filters() {
        return ['isActive', 'isTrashed', 'Search'];
    }

    
    /**
     * The relations that should be soft deleted when this gets soft deleted.
     *
     * @var array
     */
    protected $softCascade = ['cities'];
    
    
    public function cities(){
        return $this->hasMany(City::class);
    }
    
    public function users($type = null){
        return $this->hasManyThrough(User::class, City::class)
            ->type($type);
    }
    
    public function getInstructorsCountAttribute(){
       return $this->users('Instructor')->count();
    }

    public function getStudentsCountAttribute(){
       return $this->users('Student')->count();
    }

    public function getCoursesCountAttribute() {
        return Course::whereIn('instructor_id', $this->users('Instructor')->pluck('users.id'))
        ->count();
    }
}

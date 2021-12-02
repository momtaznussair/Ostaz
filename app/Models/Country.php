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

    protected $appends = ['instructors', 'students', 'courses'];

     /**
     * The relations that should be soft deleted when this gets soft deleted.
     *
     * @var array
     */
    protected $softCascade = ['cities'];


    public function cities(){
        return $this->hasMany(City::class);
    }

    public function users(){
        return $this->hasManyThrough(User::class, City::class);
    }

    public function getInstructorsAttribute(){
       return $this->users()->where('type', 'Instructor');
    }

    public function getStudentsAttribute(){
       return $this->users()->where('type', 'Student');
    }

    public function getCoursesAttribute()
    {
        //count
        return Course::whereIn('instructor_id', $this->instructors->pluck('id')->toArray());
    }
}

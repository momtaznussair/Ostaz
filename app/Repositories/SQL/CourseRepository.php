<?php

namespace App\Repositories\SQL;

use App\Models\Course;
use App\Repositories\Contracts\CourseRepositoryInterface;
use App\Repositories\SQL\Repository;

class CourseRepository extends Repository implements CourseRepositoryInterface{

    public function __construct(Course $course)
    {
        Parent::__construct($course);
    }

    public function assignToInstructor($instructor, $attributes)
    {
        return $instructor->courses()->create($attributes);
    }

    public function assignToStudent($student, $attributes)
    {
        $student->studentCourses()->attach($attributes['course']);
        return true;
    }

   
}
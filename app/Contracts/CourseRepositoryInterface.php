<?php

namespace App\Contracts;


interface CourseRepositoryInterface extends RepositoryInterface{
    // Category Specific Methods
    public function assignToInstructor($instructor, $attributes);
    public function assignToStudent($student, $attributes);
}
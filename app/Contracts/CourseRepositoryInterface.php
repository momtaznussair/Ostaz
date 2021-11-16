<?php

namespace App\Contracts;

interface CourseRepositoryInterface extends RepositoryInterface{
    // Category Specific Methods
    public function toggleActive($course, bool $active);
}
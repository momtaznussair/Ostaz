<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface extends RepositoryInterface{
    // Category Specific Methods
    public function getCourses($category);
}
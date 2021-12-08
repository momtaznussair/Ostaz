<?php

namespace App\Repositories\SQL;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends Repository implements CategoryRepositoryInterface{

    public function __construct(Category $category)
    {
       Parent::__construct($category);
    }

    public function getCourses($category)
    {
        return $this->getById($category)
        ->courses()->pluck('name', 'id');
    }
}
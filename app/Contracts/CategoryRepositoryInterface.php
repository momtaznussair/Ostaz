<?php

namespace App\Contracts;

interface CategoryRepositoryInterface extends RepositoryInterface{
    // Category Specific Methods
    public function toggleActive($category, bool $active);
}
<?php

namespace App\Contracts;

interface UserRepositoryInterface extends RepositoryInterface{
    // User Specific Methods
    public function getAllByType(string $search = '', bool $trashed = false, bool $active = true, string $type);
}
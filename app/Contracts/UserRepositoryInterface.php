<?php

namespace App\Contracts;


interface UserRepositoryInterface extends RepositoryInterface{
    // User Specific Methods
    public function getAll(string $search = '', bool $trashed = false, bool $active = true, string $type = 'Instructor', $country = null);
    public function removeImage($user);
    public function updateOrCreate($data);
}
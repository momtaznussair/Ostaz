<?php

namespace App\Contracts;


interface UserRepositoryInterface{
    // User Specific Methods
    public function getAll(string $search = '', bool $trashed = false, bool $active = true, string $type = 'Instructor', $country = null);
    public function removeImage($user);
    public function updateOrCreate($data);
    public function remove($id);
    public function restore($id);
    public function toggleActive($course, bool $active);
}
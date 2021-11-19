<?php

namespace App\Contracts;

use App\Models\Admin;

interface AdminRepositoryInterface{
    // Admin Specific Methods
    public function removeImage(Admin $admin);
    public function updateOrCreate($data);
    public function getAll(string $search = '', bool $trahsed = false, bool $active = true);
    public function remove($id);
    public function restore($id);
    public function toggleActive($course, bool $active);
}
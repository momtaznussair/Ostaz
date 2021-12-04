<?php

namespace App\Contracts;

use App\Models\Admin;

interface AdminRepositoryInterface extends RepositoryInterface{
    // Admin Specific Methods
    public function removeImage(Admin $admin);
    public function updateOrCreate($data);
}
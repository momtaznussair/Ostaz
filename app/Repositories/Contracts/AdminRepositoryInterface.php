<?php

namespace App\Repositories\Contracts;

interface AdminRepositoryInterface extends RepositoryInterface{
    // Admin Specific Methods
    public function removeImage($id);
    public function updateOrCreate($attributes);
}
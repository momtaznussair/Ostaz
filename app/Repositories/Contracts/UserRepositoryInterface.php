<?php

namespace App\Repositories\Contracts;


interface UserRepositoryInterface extends RepositoryInterface{
    // User Specific Methods
    public function removeImage($user);
    public function updateOrCreate($attributes);
    public function getByEmailOrPhone($emailorphone);
}
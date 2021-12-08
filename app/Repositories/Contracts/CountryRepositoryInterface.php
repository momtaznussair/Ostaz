<?php

namespace App\Repositories\Contracts;


interface CountryRepositoryInterface extends RepositoryInterface{
    // Country Specific Methods
    public function getCities($country);
}
<?php

namespace App\Contracts;

use App\Models\Country;

interface CountryRepositoryInterface extends RepositoryInterface{
    // Country Specific Methods
    public function getCities($country);
}
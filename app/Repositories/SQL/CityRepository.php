<?php

namespace App\Repositories\SQL;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;

class CityRepository extends Repository implements CityRepositoryInterface{

    public function __construct(City $city)
    {
        Parent::__construct($city);
    }
}
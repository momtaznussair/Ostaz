<?php

namespace App\Repositories\SQL;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;
use phpDocumentor\Reflection\Types\Parent_;

class CountryRepository extends Repository implements CountryRepositoryInterface{

    public function __construct(Country $Country)
    {
       Parent::__construct($Country);
    }

    public function getCities($country){
       return $this->getById($country)
       ->cities()->pluck('name', 'id');
    }

}
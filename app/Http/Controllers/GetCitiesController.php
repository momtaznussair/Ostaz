<?php

namespace App\Http\Controllers;

use App\Contracts\CountryRepositoryInterface;
use App\Traits\Api\ApiResponse;

class GetCitiesController extends Controller
{
    use ApiResponse;
    public function __invoke($id, CountryRepositoryInterface $countryRepository)
    {
        return $this->apiResponse($countryRepository->getCities($id), 'List of all available cities');
    }
}

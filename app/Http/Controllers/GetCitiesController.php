<?php

namespace App\Http\Controllers;

use App\Traits\Api\ApiResponse;
use App\Repositories\Contracts\CountryRepositoryInterface;

class GetCitiesController extends Controller
{
    use ApiResponse;
    public function __invoke($id, CountryRepositoryInterface $countryRepository)
    {
        return $this->apiResponse($countryRepository->getCities($id), 'List of all available cities');
    }
}

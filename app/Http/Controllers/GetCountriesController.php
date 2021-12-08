<?php

namespace App\Http\Controllers;

use App\Contracts\CountryRepositoryInterface;
use App\Traits\Api\ApiResponse;

class GetCountriesController extends Controller
{
    use ApiResponse;
    public function __invoke(CountryRepositoryInterface $countryRepository)
    {
        return $this->apiResponse($countryRepository->getAll()->pluck('name', 'id'), 'List of all available countries');
    }
}

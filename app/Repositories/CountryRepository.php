<?php

namespace App\Repositories;

use App\Contracts\CountryRepositoryInterface;
use App\Models\Country;

class CountryRepository implements CountryRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, bool $active = true)
    {
       return Country::search('name', $search)
       ->orderBy('name')
       ->isTrashed($trashed)
       ->isActive($active)
       ->paginate();
    }

    public function getById($id){
        # code...
    }

    public function getCities($country_id)
    {
       return Country::find($country_id)->cities()->pluck('name', 'id');
    }

    public function add($data)
    {
        return Country::create($data);
    }

    public function update($id, $data){
        //code
    }

    public function toggleActive($Country, bool $active){
        return $Country->update(['active' => !$active]);
    }
    public function remove($Country)
    {
      return $Country->delete();
    }

    public function getTrashed(string $keyword = '')
    {
        return  Country::search('name', $keyword)->onlyTrashed()->paginate();
    }

    public function restore($Country)
    {
        return Country::withTrashed()->find($Country)->restore();
    }
}
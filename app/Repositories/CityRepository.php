<?php

namespace App\Repositories;

use App\Models\City;
use App\Contracts\CityRepositoryInterface;

class CityRepository implements CityRepositoryInterface{

    public function getAll(string $search = '', bool $trashed = false, bool $active = true)
    {
       return  City::search('name', $search)
       ->isTrashed($trashed)
       ->isActive($active)
       ->paginate(5);
    }

    public function getById($id){}

    public function add($City)
    {
        return $City->save();
    }

    public function update($id, $City){}

    public function toggleActive($City, bool $active){
        return $City->update(['active' => !$active]);
    }
    
    public function remove($City)
    {
      return $City->delete();
    }

    public function restore($City)
    {
        return City::withTrashed()->find($City)->restore();
    }
}
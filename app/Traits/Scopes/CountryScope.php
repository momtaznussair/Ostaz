<?php

namespace App\Traits\Scopes;

use Illuminate\Database\Eloquent\Builder;

trait CountryScope {
    
    public function ScopeCountry($query, $country)
    {
       if($country){
        return $query->whereHas('city', function (Builder $query) use ($country) {
            $query->where('country_id', $country);
        });
       }
    }
}

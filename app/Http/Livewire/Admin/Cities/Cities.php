<?php

namespace App\Http\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\CityRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Contracts\CountryRepositoryInterface;
use PragmaRX\Countries\Package\Countries as CountriesRepository;

class Cities extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $search = '', $trashed = false, $active = true;
    public $name, $allCitiesOfSelectedCountry = [], $countries = [];
    public City $city;
    
    public function render(CityRepositoryInterface $cityRepository, CountryRepositoryInterface $countryRepository)
    {
        $this->countries =  $countryRepository->getAll()->pluck('name', 'id');
        return view('livewire.admin.cities.cities', [
            'cities' => $cityRepository
            ->getAll($this->active, ['isTrashed' => $this->trashed, 'search' => $this->search]),
        ]);
    }

    public function mount(){
        $this->city = new City();
    }

    public function rules()
    {
       return [
           'city.name' => 'required|string|max:255|unique:cities,name',
           'city.country_id' => 'required|exists:countries,id'
       ];
    }


    public function getCities()
    {
        return CountriesRepository::where('name.common', $this->countries[$this->city->country_id])
        ->first()
        ->hydrateStates()
        ->states
        ->sortBy('name.common')
        ->pluck('name')->toArray();
    }

    public function select(City $city)
    {
       $this->resetValidation();
       $this->city = $city;
       $this->name = $city->name;
    }

    public function save(CityRepositoryInterface $cityRepository)
    {
        $this->authorize('City_create');
        $this->validate();
        $cityRepository->add($this->city->toArray()) && 
        $this->emit('success', __('Created Successfully!'));
        $this->city = new City();
    }

    public function toggleActive(Bool $active, CityRepositoryInterface $cityRepository)
    {
       $this->authorize('Course_edit');
        $cityRepository->toggleActive($this->city->id, $active) && 
        $this->emit('success', __('Changes Saved!'));
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(CityRepositoryInterface $cityRepository)
    {
        $this->authorize('Course_delete');
        $cityRepository->remove($this->city->id) &&
        $this->emit('success', __('Deleted successfully!'));
    }

    public function restore($city, CityRepositoryInterface $cityRepository)
    {
        $this->authorize('Course_delete');
        $cityRepository->restore($city) &&
        $this->emit('success', __('Item restored!'));
    }
}

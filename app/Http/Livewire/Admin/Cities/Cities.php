<?php

namespace App\Http\Livewire\Admin\Cities;

use App\Models\City;
use Livewire\Component;
use Livewire\WithPagination;
use PragmaRX\Countries\Package\Countries as CountriesRepository;
use App\Contracts\CityRepositoryInterface;
use App\Contracts\CountryRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Cities extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $search = '', $trashed = false, $active = true;
    public $name, $allCitiesOfSelectedCountry = [];
    public City $city;
    
    public function render(CityRepositoryInterface $cityRepository, CountryRepositoryInterface $countryRepository)
    {
        return view('livewire.admin.cities.cities', [
            'cities' => $cityRepository
            ->getAll($this->search, $this->trashed, $this->active),
            'countries' => $countryRepository->getAll()->pluck('name', 'id')
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


    public function getCities(CountryRepositoryInterface $countryRepository)
    {
        $allCountries = $countryRepository->getAll()->pluck('name', 'id');

        $this->allCitiesOfSelectedCountry = CountriesRepository::where('name.common', $allCountries[$this->city->country_id])
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
        $cityRepository->add($this->city) && 
        $this->emit('success', __('Created Successfully!'));
        $this->city = new City();
    }

    public function toggleActive(Bool $active, CityRepositoryInterface $cityRepository)
    {
       $this->authorize('Course_edit');
        $cityRepository->toggleActive($this->city, $active) && 
        $this->emit('success', __('Changes Saved!'));
    }

    public function delete(CityRepositoryInterface $cityRepository)
    {
        $this->authorize('Course_delete');
        $cityRepository->remove($this->city) &&
        $this->emit('success', __('Deleted successfully!'));
    }

    public function restore($city, CityRepositoryInterface $cityRepository)
    {
        $this->authorize('Course_delete');
        $cityRepository->restore($city) &&
        $this->emit('success', __('Item restored!'));
    }
}

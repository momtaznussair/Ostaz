<?php

namespace App\Http\Livewire\Admin\Countries;

use App\Models\Country;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Contracts\CountryRepositoryInterface;
use PragmaRX\Countries\Package\Countries as AllCountries; 


class Countries extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $trashed = false, $active = true, $search = '';
    public Country $country;
    public $name, $allCountries;

    public function render(CountryRepositoryInterface $countryRepository)
    {
        $this->authorize('Country_access');
        return view('livewire.admin.countries.countries', [
            'countries' => $countryRepository->getAll($this->active, ['isTrashed' => $this->trashed,  'Search' => $this->search]),
        ]);
    }


    public function mount()    {
       $this->allCountries = AllCountries::sortBy('name.common')->all()->pluck('name.common')->toArray();
    }

    protected function rules()
    {
        return [ 'name' => ['required', 'unique:countries,name', 
            Rule::in($this->allCountries)
        ] ];
    }

    public function select(Country $country)
    {
        $this->country = $country;
        $this->name = $country->name;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function save(CountryRepositoryInterface $countryRepository)
    {
        $this->authorize('Country_create');
        $countryRepository->add($this->validate()) && 
        $this->reset('name');
        $this->emit('success', __('Created Successfully!'));
    }

    public function delete(CountryRepositoryInterface $countryRepository)
    {
        $this->authorize('Country_delete');
        $countryRepository->remove($this->country->id) &&
        $this->emit('success', __('Deleted successfully!'));
        $this->reset('name');
    }

    public function toggleActive(Bool $active, CountryRepositoryInterface $countryRepository)
    {
        $this->authorize('Country_edit');
        $countryRepository->toggleActive($this->country->id, $active) && 
        $this->emit('success', __('Changes Saved!'));
    }

    public function restore($country, CountryRepositoryInterface $countryRepository)
    {
        $this->authorize('Country_delete');
        $countryRepository->restore($country) &&
        $this->emit('success', __('Item restored!'));
    }
}
    
<?php

namespace App\Http\Livewire\Admin\Reports;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Contracts\CountryRepositoryInterface;

class Countries extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = '';

    public function render(CountryRepositoryInterface $countryRepository)
    {
        $this->authorize('Country_report_view');
        return view('livewire.admin.reports.countries', [
            'countries' => $countryRepository->getAll(true, ['search' => $this->search])
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

}

<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Contracts\CountryRepositoryInterface;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Countries extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = '';

    public function render(CountryRepositoryInterface $countryRepository)
    {
        $this->authorize('Country_report_view');
        return view('livewire.admin.reports.countries', [
            'countries' => $countryRepository->getAll($this->search)
        ]);
    }

}

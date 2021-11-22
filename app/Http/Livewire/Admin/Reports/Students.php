<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Contracts\CountryRepositoryInterface;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Students extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $search = '', $countryFilter;
    public User $user;

    public function render(UserRepositoryInterface $userRepository, CountryRepositoryInterface $countryRepository)
    {
        $this->authorize('Student_report_view');

        return view('livewire.admin.reports.students', [
            'students' => $userRepository->getAll($this->search, false, true, 'Student', $this->countryFilter),
            'countries' => $countryRepository->getAll()->pluck('name', 'id')
        ]);
    }

    public function mount(){ $this->user = new User(); }

    public function select(User $user, String $purpose = null){
        //if it's the courses button that was pressed we just send the selected Admin to the updateOrCreate Component
        if($purpose == 'toViewCourses'){ return $this->emitTo('admin.students.assign-courses-to-students', 'userSelected', ['user' => $user]); }
    }
}

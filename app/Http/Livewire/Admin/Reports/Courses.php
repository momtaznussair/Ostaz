<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Contracts\CourseRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Courses extends Component
{
    use WithPagination, AuthorizesRequests;
    public $search = '', $category;
    public function render(CourseRepositoryInterface $courseRepository)
    {
        $this->authorize('Course_report_view');
        return view('livewire.admin.reports.courses', [
            'courses' => $courseRepository->getAll($this->search, false, true, $this->category)
        ]);
    }
}
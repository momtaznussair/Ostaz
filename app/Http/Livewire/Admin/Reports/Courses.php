<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;
use App\Repositories\Contracts\CourseRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Courses extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public $search = '', $category;
    public function render(CourseRepositoryInterface $courseRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->authorize('Course_report_view');
        return view('livewire.admin.reports.courses', [
            'courses' => $courseRepository->getAll(true, ['Search' => $this->search, 'withCount' => 'student', 'with' => ['instructor', 'category']]),
            'categories' => $categoryRepository->getAll()
        ]);
    }

    public function updatingSearch() {
        $this->resetPage();
    }
}

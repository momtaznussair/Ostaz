<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Repositories\Contracts\AdminRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Admins extends Component
{
    use WithPagination, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $name, $trashed = false, $active = true, $search = '';
    public Admin $admin;

    protected $listeners = ['changesSaved' => '$refresh'];

    public function render(AdminRepositoryInterface $adminRepository)
    {
        $this->authorize('Admin_access');
        return view('livewire.admin.admins.admins', [
            'admins' => $adminRepository->getAll($this->active, ['isTrashed' => $this->trashed,  'Search' => $this->search]),
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(){ $this->admin = new Admin(); }


    public function select(Admin $admin, $toUpdate = false){
        //if it's the edit button that was pressed we just send the selected Admin to the updateOrCreate Component
        if($toUpdate){ return $this->emit('adminSelected', ['admin' => $admin]); }
        $this->admin = $admin;
        $this->name = $admin->name;
    }

    public function delete(AdminRepositoryInterface $adminRepository){
        $this->authorize('Admin_delete');
        $adminRepository->remove($this->admin->id) && 
        $this->emit('success', __('Deleted successfully!'));
    }

    public function restore($admin, AdminRepositoryInterface $adminRepository){
        $this->authorize('Admin_delete');
        $adminRepository->restore($admin['id']) &&
        $this->emit('success', __('Item restored!'));
    }

    public function toggleActive(Bool $active, AdminRepositoryInterface $adminRepository)
    {
       $this->authorize('Admin_edit');
       $adminRepository->toggleActive($this->admin->id, $active) && 
       $this->emit('success', __('Changes Saved!'));
    }

}

<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use App\Contracts\AdminRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Admins extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['adminsUpdated' => '$refresh'];

    public $selectedAdmin;

    public function render(AdminRepositoryInterface $adminRepository)
    {
        $this->authorize('Admin_access');
        return view('livewire.admin.admins.admins', [
            'admins' => $adminRepository->getAll()
        ]);
    }

    public function Select($admin, AdminRepositoryInterface $adminRepository)
    {
        $this->selectedAdmin = $adminRepository->getById($admin['id']);
        $this->emitTo('admin.admins.edit', 'newSelect', ['admin' => $admin['id']]);
    }
    
    public function delete(AdminRepositoryInterface $adminRepository){
        $this->authorize('Admin_delete');
        $adminRepository->remove($this->selectedAdmin->id) && 
        $this->emit('success', __('Deleted successfully!'));
    }
}

<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use App\Contracts\RoleRepositoyInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Roles extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination, AuthorizesRequests;

    public $selectedTodelete;
    
    public function render(RoleRepositoyInterface $roleRepository)
    {
        $this->authorize('Role_access');
        return view('livewire.admin.roles.roles', [
            'roles' => $roleRepository->getAll()
        ]);
    }

    public function selectToDelete($role)
    {
        $this->selectedTodelete = $role;
    }

    public function delete(RoleRepositoyInterface $roleRepository)
    {
        $this->authorize('Role_delete');
        $success = $roleRepository->remove($this->selectedTodelete['id']);
        if($success){
           return $this->emit('success', __('Deleted successfully!'));
        }
        $this->emit('failed', __("Unknown error, we could't Complete the Operation!"));
    }
}

<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use App\Contracts\RoleRepositoyInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    use WithPagination, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';

    public Role $role;
    public $name;
    
    public function render(RoleRepositoyInterface $roleRepository)
    {
        $this->authorize('Role_access');
        return view('livewire.admin.roles.roles', [
            'roles' => $roleRepository->getAll()
        ]);
    }

    public function select(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
    }

    public function delete(RoleRepositoyInterface $roleRepository)
    {
        $this->authorize('Role_delete');
        $success = $roleRepository->remove($this->role->id);
        if($success){
           return $this->emit('success', __('Deleted successfully!'));
        }
        $this->emit('failed', __("Unknown error, we could't Complete the Operation!"));
    }
}

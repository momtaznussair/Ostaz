<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use App\Contracts\RoleRepositoyInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination, AuthorizesRequests;

    public $name, $role_id;
    
    public function render(RoleRepositoyInterface $roleRepository)
    {
        $this->authorize('Role_access');
        return view('livewire.admin.roles.roles', [
            'roles' => $roleRepository->getAll()
        ]);
    }

    public function selectToDelete($role)
    {
        $this->name = $role['name'];
        $this->role_id = $role['id'];
    }

    public function delete(RoleRepositoyInterface $roleRepository)
    {
        dd($this->role);
        $this->authorize('Role_delete');
        $success = $roleRepository->remove($this->role_id);
        if($success){
           return $this->emit('success', __('Deleted successfully!'));
        }
        $this->emit('failed', __("Unknown error, we could't Complete the Operation!"));
    }
}

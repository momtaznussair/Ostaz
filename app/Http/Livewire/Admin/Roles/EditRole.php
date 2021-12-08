<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditRole extends Component
{
    use AuthorizesRequests;
    
    public $role, $name, $permissions, $allPermissions;

    public function render()
    {
        return view('admin.roles.CreateOrUpdateForm', [
            'allPermissions' => $this->allPermissions,
        ]);
    }

    public function mount(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->permissions = $role->permissions()->pluck('id');   
        $this->allPermissions = Permission::all();   
    }

    public function rules(){
        return [
            'name' => 'required|max:255|unique:roles,name,'. $this->role->id,
            'permissions' => 'required|exists:permissions,id',
    ];}

    public function toggleSelectAll($status)
    {
        if($status){
            return $this->permissions = $this->allPermissions->pluck('id');
        }
        $this->permissions = [];
    }

    public function submit(RoleRepositoryInterface $roleRepository)
    {
        $this->authorize('Role_edit');

        $validData = $this->validate();
        $success = $roleRepository->update($this->role->id, $validData);
        if($success){
            session()->flash('success', __('Changes Saved!'));
            return redirect()->route('admin.roles.index');
        }
        $this->emit('failed', __("Unknown error, we could't Complete the Operation!"));
    }
}

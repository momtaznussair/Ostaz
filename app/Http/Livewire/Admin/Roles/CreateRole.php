<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateRole extends Component
{
    use AuthorizesRequests;

    public $name, $allPermissions;
    public $permissions = [];
    public function render()
    {
        $this->allPermissions = Permission::all();  
        
        return view('admin.roles.CreateOrUpdateForm', [
            'allPermissions' => $this->allPermissions,
        ]);
    }

    protected $rules = [
        'name' => 'required|max:255|unique:roles,name',
        'permissions' => 'required|array',
        'permissions.*' => 'exists:permissions,id'
    ];

    public function toggleSelectAll($status)
    {
        if($status){
            return $this->permissions = $this->allPermissions->pluck('id', 'id');
        }
        $this->reset('permissions');
    }
    public  function submit(RoleRepositoryInterface $roleRepository)
    {
        $this->authorize('Role_create');
        // remove any Falsy values 'selected and then deselected permissions'
        $this->permissions = collect($this->permissions)->reject( function($value) { 
            return !$value;
        });
        $validData = $this->validate();
        $success = $roleRepository->add($validData);
        if($success){
            session()->flash('success', __('Created Successfully!'));
            return redirect()->route('admin.roles.index');
        }
        $this->emit('failed', __("Unknown error, we could't Complete the Operation!"));
    }
}

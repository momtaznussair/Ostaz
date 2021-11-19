<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Contracts\RoleRepositoyInterface;
use Illuminate\Validation\Rules\Password;
use App\Contracts\AdminRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{
    use WithFileUploads,  AuthorizesRequests;

    public $avatar, $password, $password_confirmation, $roles;
    public Admin $admin;
    public function render(RoleRepositoyInterface $roleRepository)
    {
        $this->authorize('Admin_create');
        return view('livewire.admin.admins.create', [
            'allRoles' => $roleRepository->getAll()
            ->pluck('name', 'id')
        ]);
    }

    public function mount(){  $this->admin = new Admin(); }

    public function rules()
    {
        return [
            'admin.name' => 'required|max:255|string',
            'admin.email' => 'required|email|max:255|unique:admins,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'admin.phone' => 'required|digits:11|numeric|unique:admins,phone',
            'admin.active' => 'required|boolean',
            'avatar' =>  'nullable|image|max:1024', //1MB Max
            'roles' => 'required|array|exists:roles,id',
        ];
    }

    public function save(AdminRepositoryInterface $adminRepository)
    {
        $this->authorize('Admin_create');
        $adminRepository->add($this->validate()) &&
        $this->emitUp('changesSaved');
        $this->emit('success', __('Created Successfully!'));
        $this->resetAll();
    }

    public function resetAll()
    {
        $this->reset('roles', 'avatar', 'password', 'password_confirmation');
        $this->admin = new Admin();
    }
}

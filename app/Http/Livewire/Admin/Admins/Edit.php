<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Contracts\RoleRepositoyInterface;
use Illuminate\Validation\Rules\Password;
use App\Contracts\AdminRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Component
{
    use WithFileUploads,  AuthorizesRequests;

    public $roles, $avatar, $password, $password_confirmation, $admin;

    protected $listeners = ['newSelect'];
    
    public function render(RoleRepositoyInterface $roleRepository)
    {
        $this->authorize('Admin_edit');
        return view('livewire.admin.admins.edit', [
            'allRoles' => $roleRepository->getAll()
            ->pluck('name', 'id')
        ]);
    }

    public function newSelect(Admin $admin)
    {
       $this->admin = $admin;
       $this->roles = $admin->roles->pluck('id');
    }

    public function mount(){
        $this->roles = $this->admin->roles->pluck('id');
    }

    public function rules()
    {
        return [
            'admin.name' => 'required|max:255|string',
            'admin.email' => 'required|email|max:255|unique:admins,email,'.$this->admin->id,
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'admin.phone' => 'required|digits:11|numeric|unique:admins,phone,'.$this->admin->id,
            'admin.active' => 'required|boolean',
            'avatar' =>  'nullable|image|max:1024', //1MB Max
            'roles' => 'required|array|exists:roles,id',
        ];
    }

    public function confirmDelete()
    {
        $this->emit('confirmDelete');
    }

    public function deleteImage()
    {
        //delete from storage
        Storage::delete($this->admin->avatar);
        $this->admin->avatar = 'admins/default.jpg';
        $this->admin->save();
        $this->emit('deleted');
        $this->emit('adminsUpdated');
    }

    public function submit()
    {
        dd($this->admin->phone);
        $this->validate();
    }
}

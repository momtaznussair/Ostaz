<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rules\Password;
use App\Contracts\AdminRepositoryInterface;
use App\Contracts\RoleRepositoyInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;

class Admins extends Component
{
    use WithPagination, AuthorizesRequests, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $trashed = false, $active = true, $search = '', $updateMode = false;
    public $name,$roles, $avatar, $password, $password_confirmation;
    public Admin $admin;

    public function render(AdminRepositoryInterface $adminRepository, RoleRepositoyInterface $roleRepository)
    {
        $this->authorize('Admin_access');
        return view('livewire.admin.admins.admins', [
            'admins' => $adminRepository->getAll($this->search, $this->trashed, $this->active),
            'allRoles' => $roleRepository->getAll()
            ->pluck('name', 'id')
        ]);
    }

    public function mount(){
        $this->admin = new Admin();
    }


    protected function rules(){
      $rules = [
            'admin.name' => 'required|max:255|string',
            'admin.email' => 'required|email|max:255|unique:admins,email',
            'password' => ['required', 'confirmed', Password::defaults()],
            'admin.phone' => 'required|digits:11|numeric|unique:admins,phone',
            'admin.active' => 'required|boolean',
            'avatar' =>  'nullable|image|max:1024', //1MB Max
            'roles' => 'required|array|exists:roles,id',
       ];

       if($this->updateMode){
            $rules['admin.email'] = 'required|email|max:255|unique:admins,email,'.$this->admin->id;
            $rules['admin.phone'] = 'required|digits:11|numeric|unique:admins,phone,'.$this->admin->id;
            $rules['password'] = ['nullable', 'confirmed', Password::defaults()];
       }
       return $rules;
    }

    public function select(Admin $admin)
    {
        $this->admin = $admin;
        $this->name = $admin->name;
        $this->roles= $admin->roles->pluck('id')->toArray();
        $this->reset('password', 'password_confirmation');
        $this->resetValidation();
    }

    public function save(AdminRepositoryInterface $adminRepository)
    {
        $this->authorize('Admin_create');
        $this->updateMode = false;
        $adminRepository->add($this->validate()) &&
        $this->emit('success', __('Created Successfully!'));
        $this->admin = new Admin();
        $this->reset('avatar', 'password', 'password_confirmation', 'roles');
    }

    public function update(AdminRepositoryInterface $adminRepository){
        $this->authorize('Admin_edit');
        $this->updateMode = true;
        $adminRepository->update($this->admin,$this->validate()) &&
        $this->emit('success', __('Changes Saved!'));
        $this->admin = new Admin();
        $this->reset('avatar', 'password', 'password_confirmation', 'roles');
    }
    
    public function delete(AdminRepositoryInterface $adminRepository){
        $this->authorize('Admin_delete');
        $adminRepository->remove($this->admin) && 
        $this->emit('success', __('Deleted successfully!'));
    }

    public function confirmDelete(){
        $this->emit('confirmDelete');
    }

    public function deleteImage(AdminRepositoryInterface $adminRepository){
        $adminRepository->removeImage($this->admin) && 
        $this->emit('deleted');
    }

    public function restore($admin, AdminRepositoryInterface $adminRepository){
        $this->authorize('Admin_delete');
        $adminRepository->restore($admin['id']) &&
        $this->emit('success', __('Item restored!'));
    }

    public function toggleActive(Bool $active, AdminRepositoryInterface $adminRepository)
    {
       $this->authorize('Admin_edit');
       $adminRepository->toggleActive($this->admin, $active) && 
       $this->emit('success', __('Changes Saved!'));
    }
}

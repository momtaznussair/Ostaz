<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class UpdateProfile extends Component
{
    use WithFileUploads;

    public Admin $admin;
    public $avatar;
    public function render()
    {
        return view('livewire.admin.profile.update-profile');
    }

    public function rules()
    {
        return [
            'admin.name' => 'required|max:255|string',
            'admin.email' => 'required|email|max:255|unique:admins,email,'.Auth('admin')->user()->id,
            'admin.phone' => 'required|digits:11|numeric|unique:admins,phone,'.Auth('admin')->user()->id,
            'avatar' =>  'nullable|image|max:1024', //1MB Max
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function mount()
    {
        $this->admin = Auth('admin')->user();
    }

    public function deleteImage()
    {
        //delete from storage
        Storage::delete($this->admin->avatar);
        $this->admin->avatar = 'admins/default.jpg';
        $this->admin->save();
        $this->emit('deleted');
    }

    public function confirmDelete()
    {
        $this->emit('confirmDelete');
    }

    public function save()
    {
        $validData = $this->validate();
        if($this->avatar){
            $path = $this->storeImage($this->avatar);
            if($path){
                $this->admin->avatar = $path;
                $this->reset('avatar');
            }else
            $this->emit(__("Unknown Error, We couldn't save image!"));
        }

        $this->admin->save();
        $this->emit('profileUpdated');
    }

    private function storeImage($avatar)
    {
        if(!$avatar){
            return false;
        }
        //store it
        $path = $avatar->store('admins');
        if(!$path){
            return false;
        }
        //store it in database
        return $path;
    }
}

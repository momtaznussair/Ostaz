<?php

namespace App\Http\Livewire\Admin\Instructors;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\CountryRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Instructors extends Component
{
    use WithPagination, WithFileUploads, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    public $trashed = false, $active = true, $search = '', $inUpdateMode = false;
    public $name, $avatar, $password, $password_confirmation, $country, $cities = [];
    public User $user;

    public function render(UserRepositoryInterface $userRepository, CountryRepositoryInterface $countryRepository)
    {
        return view('livewire.admin.instructors.instructors', [
            'instructors' => $userRepository->getAllByType($this->search, $this->trashed, $this->active, 'Instructor'),
            'countries' => $countryRepository->getAll()->pluck('name', 'id')->toArray()
        ]);
    }

    public function mount()
    {
        $this->user = new User();
        $this->user->type = "Instructor";
    }

    public function getCities(CountryRepositoryInterface $countryRepository)
    {
        $this->cities = $countryRepository->getCities($this->country)->toArray();
        dd([$this->cities, $this->user]);
    }

    public function select(User $user, CountryRepositoryInterface $countryRepository)
    {
        $this->user = $user;
        $this->name = $this->user->name;
        $this->country = $this->user->city->country_id;
        $this->cities = $countryRepository->getCities($this->country)->toArray();
    }

    protected function rules()
    {
       $rules = [
            'user.name' => 'required|string|max:255',
            'user.email' => 'required|email|unique:users,email',
            'user.phone' => 'required|digits:11|numeric|unique:users,phone',
            'user.city_id' => 'required|exists:cities,id',
            'country' => 'required|exists:countries,id',
            'avatar' =>  'nullable|image|max:1024', //1MB Max
            'password' => ['required', 'confirmed', Password::defaults()],
            'user.age' => 'required|integer|min:13',
            'user.gender' => ['required', Rule::in(['m', 'f']) ],
            'user.type' => ['required', Rule::in(['Instructor', 'Student']) ],
            
       ];

       if($this->inUpdateMode){
            $rules['user.email'] = 'required|email|unique:users,email,' . $this->user->id;
            $rules['user.phone'] = 'required|digits:11|numeric|unique:users,phone,' . $this->user->id;
            $rules['password'] = ['nullable', 'confirmed', Password::defaults()];
       }

       return $rules;
    }

    public function save(UserRepositoryInterface $userRepository)
    {
        $this->authorize('User_create');
        $this->inUpdateMode = false;
        $userRepository->add($this->validate()) &&
        $this->user = new User();
        $this->reset('avatar', 'password', 'password_confirmation');
        $this->resetValidation();
        $this->emit('success', __('Created Successfully!'));
    }

    public function update(UserRepositoryInterface $userRepository)
    {
        $this->authorize('User_edit');
        $this->inUpdateMode = true;
        $userRepository->update($this->user ,$this->validate()) &&
        $this->emit('success', __('Changes Saved!'));
        $this->user = new User();
        $this->reset('avatar', 'password', 'password_confirmation');
    }

    public function delete(UserRepositoryInterface $userRepository){
        $this->authorize('User_delete');
        $userRepository->remove($this->user) && 
        $this->emit('success', __('Deleted successfully!'));
    }

    public function restore($user, UserRepositoryInterface $userRepository){
        $this->authorize('Admin_delete');
        $userRepository->restore($user) &&
        $this->emit('success', __('Item restored!'));
    }

    public function toggleActive(Bool $active, UserRepositoryInterface $userRepository)
    {
       $this->authorize('User_edit');
       $userRepository->toggleActive($this->user, $active) && 
       $this->emit('success', __('Changes Saved!'));
    }
}


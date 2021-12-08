<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CountryRepositoryInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UpdateOrCreateUser extends Component
{
    use WithFileUploads, AuthorizesRequests;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['userSelected'];

    public $avatar, $password, $password_confirmation, $country, $cities = [];
    public $mode = 'create'; //create or edit
    public $userRole; //Instructor or Student
    public User $user;

    public function render(CountryRepositoryInterface $countryRepository)
    {
        return view('livewire.admin.users.update-or-create-user', [
            'countries' => $countryRepository->getAll()->pluck('name', 'id')->toArray()
        ]);
    }

    public function mount() {
        $this->user = new User();
        $this->user->type = $this->userRole; //Instructor Or Student (Determined by the calling parent)
    }

    public function userSelected(User $user, CountryRepositoryInterface $countryRepository){
        $this->mode = 'edit';
        $this->user = $user;
        $this->country = $user->city->country_id;
        $this->cities = $countryRepository->getCities($this->country)->toArray();
        $this->reset('avatar');
     }
 

    public function getCities(CountryRepositoryInterface $countryRepository){
        $this->cities = $this->country ? $countryRepository->getCities($this->country)->toArray() : [];
    }

    protected function rules()
    {
       $rules = [
            'user.id' => 'nullable',
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

       if($this->mode == 'edit'){
            $rules['user.email'] = 'required|email|unique:users,email,' . $this->user->id;
            $rules['user.phone'] = 'required|digits:11|numeric|unique:users,phone,' . $this->user->id;
            $rules['password'] = ['nullable', 'confirmed', Password::defaults()];
       }
       return $rules;
    }

    /**
     * update selected user or create a new one
     */
    public function submit(UserRepositoryInterface $userRepository){
        $this->authorize('User_' . $this->mode); // ('User_create') or ('User_edit')
        $userRepository->updateOrCreate($this->validate()) && 
        $this->emitUp('usersUpdated');
        $this->emit('success', $this->successMessages()[$this->mode]);
        $this->resetAll();
    }

    private function successMessages()
    {
        return [
            'create' => __('Created Successfully!'),
            'edit' => __('Changes Saved!')
        ];
    }

    public function resetAll(){
        $this->reset('avatar', 'password', 'password_confirmation', 'mode', 'cities', 'country');
        $this->resetValidation();
        $this->user = new User();
    }

    //remove image
    public function confirmDelete()
    {
        $this->emit('confirmDelete');
    }

    public function deleteImage(UserRepositoryInterface $userRepositroy){
        $userRepositroy->removeImage($this->user) && 
        $this->emit('deleted');
        $this->emitUp('usersUpdated');
    }
}

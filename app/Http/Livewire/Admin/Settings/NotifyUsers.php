<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Notifications\NotifyUser;
use Illuminate\Support\Facades\Notification;
use App\Repositories\Contracts\UserRepositoryInterface;

class NotifyUsers extends Component
{
    public $userType, $content;

    public function render()
    {
        return view('livewire.admin.settings.notify-users');
    }

    protected function rules(){
        return [
            'content' => 'required|string',
            'userType' => [
                'nullable',
                Rule::in(['Instructor', 'Student', 'All']),
            ]
        ];
    }


    public function notify(UserRepositoryInterface $userRepository)
    {
       $content = $this->Validate();
       $users = $userRepository->getAll(true, ['type' => $this->userType]);
       Notification::send($users->all(), new NotifyUser($content));
       $this->reset();
       $this->emit('Notified');
    }
}

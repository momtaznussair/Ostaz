<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Mail\ResponesToUser;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Contracts\UserMessagesRepositoryInterface;

class UserMessages extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search = '', $trashed = false, $type = 'contact';
    public $selectedMessage, $email, $subject, $message, $name;

    public function render(UserMessagesRepositoryInterface $messagesRepository)
    {
        $this->authorize('UserMessages_access');

        return view('livewire.admin.settings.user-messages', [
            'messages' => $messagesRepository->getAll(null, ['search' => $this->search, 'isTrashed' =>  $this->trashed, 'type' => $this->type])
        ]);
    }

    protected $rules = [
        'email' => 'required|email',
        'name' => 'required',
        'subject' => 'required|string|max:255',
        'message' => 'required|string'
    ];

    public function select($message){
       $this->selectedMessage = $message;
       $this->email = $message['email'];
       $this->name = $message['name'];
    }

    public function delete($message, UserMessagesRepositoryInterface $messagesRepository){
        $this->authorize('UserMessages_delete');
        $messagesRepository->remove($message) && 
        $this->emit('success', __('Deleted successfully!'));
    }

    public function restore($message, UserMessagesRepositoryInterface $messagesRepository){
        $this->authorize('UserMessages_delete');
        $messagesRepository->restore($message) && 
        $this->emit('success', __('Item restored!'));
    }

    public function reply()
    {
        $this->authorize('user_messages_reply');
        $data = $this->validate();
        Mail::send(new ResponesToUser($data));
        $this->reset('subject', 'message');
        $this->emit('success', __('Message Sent Successfully!'));
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResponesToUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }


    public function build()
    {
        return $this->to($this->data['email'])
        ->subject($this->data['subject'])
        ->markdown('mail.respones-to-user', ['message' => $this->data['message'], 'name' => $this->data['name']]);
    }
}

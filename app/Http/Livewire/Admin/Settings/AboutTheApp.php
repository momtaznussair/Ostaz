<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;

class AboutTheApp extends Component
{
    use WithFileUploads;
    public $image, $title, $content;
    public function render()
    {
        return view('livewire.admin.settings.about-the-app');
    }

    protected function rules()
    {
       return [
            'image' =>  'required|image|max:1024', //1MB Max
            'title' => 'required|string|max:255',
            'content' => 'required|string'
       ];
    }

    public function save()
    {
        dd($this->validate());
    }
}

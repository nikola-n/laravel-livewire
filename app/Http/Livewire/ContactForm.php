<?php

namespace App\Http\Livewire;

use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    //wire:model="name" in the input name
    //as you type on the input the ajax requests are sent.
    //you can change the execution time by adding wire:model.debounce.500ms
    //wire:model.lazy, it will send request after you focus off the input.
    //wire:model.defer, it will not make ajax request until we hit
    //the submit button.

    //On the form: wire:submit..prevent="submitForm"
    //wire:loading, wire:target="submitForm"
    //wire:click="$set('successMessage', null)"
    public $name;

    public $email;

    public $phone;

    public $message;

    public $successMessage;

    protected $rules = [
        'name'    => 'required',
        'email'   => 'required|email',
        'phone'   => 'required',
        'message' => 'required|min:5',
    ];

    //real-time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $contact = $this->validate();

        //$contact['name']    = $this->name;
        //$contact['email']   = $this->email;
        //$contact['phone']   = $this->phone;
        //$contact['message'] = $this->message;

        sleep(1);
        Mail::to('nikola@nikola.com')->send(new  ContactFormMailable($contact));

        $this->successMessage = 'We received your message successfully and will get back to you shortly!';
        //session()->flash('success_message', 'We received your message successfully and will get back to you shortly!');

        $this->reset();
    }

    //private function resetForm($param)
    //{
    //    $this->name = '';
    //    $this->email = '';
    //    $this->phone = '';
    //    $this->message = '';
    //}

    public function render()
    {
        return view('livewire.contact-form');
    }
}

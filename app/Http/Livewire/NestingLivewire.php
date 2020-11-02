<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

//parent component
class NestingLivewire extends Component
{
    public $contacts;

    protected $listeners = ['foo' => '$refresh'];

    public function mount()
    {
        $this->contacts = Contact::all();
    }

    //public function refreshChildren()
    //{
    //    $this->emit('refreshChildren', 'foo');
    //}

    public function removeContact($name)
    {
        Contact::whereName($name)->first()->delete();
        //refresh the contacts, if we dont add this it still gonna show all from above method
        $this->contacts = Contact::all();
    }

    public function render()
    {
        return view('livewire.nesting-livewire');
    }
}

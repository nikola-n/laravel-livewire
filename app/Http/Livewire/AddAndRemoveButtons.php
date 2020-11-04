<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class AddAndRemoveButtons extends Component
{
    use WithPagination;

    public $name, $phone;

    public $inputs = [];

    public $i = 1;

    public $messages = [
        'name.0.required'  => 'Name field is required',
        'phone.0.required' => 'Phone field is required',
        'name.*.required'  => 'Name field is required',
        'phone.*.required' => 'Phone field is required',
    ];

    public $successMessage;

    public $rules = [
        'name.0'  => 'required',
        'phone.0' => 'required',
        'name.*'  => 'required',
        'phone.*' => 'required',
    ];

    /**
     * @param $i
     */
    public function add($i)
    {
        $i       = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    /**
     * @param $i
     */
    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields()
    {
        $this->name  = '';
        $this->phone = '';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, $this->rules, $this->messages);
    }

    public function store()
    {
        $this->validate($this->rules, $this->messages);

        foreach ($this->name as $key => $value) {
            Contact::create(['name' => $this->name[$key], 'phone' => $this->phone[$key]]);
        }

        $this->inputs = [];

        $this->resetInputFields();

        sleep(2);
        $this->successMessage = 'Contact Has Been Created Successfully.';
        $this->contacts       = Contact::paginate(10);

    }

    public function render()
    {
        return view('livewire.add-and-remove-buttons',
            ['contacts' => Contact::paginate(10)]);
    }
}

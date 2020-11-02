<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class HelloWorld extends Component
{
    public $name = 'nikola';

    public $loud = false;

    public $greeting = ['Hello'];

    public function mount(Request $request, $name) {
        $this->name = $request->input('name', $name);
    }

    public function updatedName()
    {
        return $this->name = strtoupper($this->name);
    }
    //public function hydrate()
    //{
    //    $this->name = 'hydrated!';
    //}

    public function render()
    {
        return view('livewire.hello-world');
    }

    //public function resetName($name = 'Chico')
    //{
    //    $this->name = $name;
    //}
}

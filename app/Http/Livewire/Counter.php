<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    /**
     * @var int
     */
    public $count = 0;
    //every property here is passed directly into the view.

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }


    public function render()
    {
        return view('livewire.counter');
    }
}
//To interact between the class and the blade we use
//livewire directives.

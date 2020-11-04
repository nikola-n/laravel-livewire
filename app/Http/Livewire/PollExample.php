<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PollExample extends Component
{
    //update the component in a specific time
    //wire:poll.1s

    public $revenue;

    public function mount()
    {
        $this->getRevenue();
    }
    public function getRevenue()
    {
        $this->revenue = DB::table('orders')->sum('price');
    }

    public function render()
    {
        return view('livewire.poll-example');
    }
}

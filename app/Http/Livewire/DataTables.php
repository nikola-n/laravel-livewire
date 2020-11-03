<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class DataTables extends Component
{
    use WithPagination;

    public $active = true;

    public $search;

    public $sortField;

    public $sortAsc = true;

    //track it in the URL
    protected $queryString = ['search', 'active', 'sortAsc', 'sortField'];

    //reset pagination after filtring data
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function render()
    {
        //(A OR B) AND C
        return view('livewire.data-tables',
            [
                'users' => User::where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                })->where('active', $this->active)
                    ->when($this->sortField, function ($query) {
                        $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
                    })->paginate(10),
            ]);
    }

    //to customize the links
    //public function paginationView()
    //{
    //    return 'livewire.custom-pagination-links-view';
    //}
}

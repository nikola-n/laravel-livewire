<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SortIcon extends Component
{

    public $field;
    public $sortField;
    public $sortAsc;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($field, $sortAsc, $sortField)
    {
        $this->field = $field;
        $this->sortAsc = $sortAsc;
        $this->sortField = $sortField;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sort-icon');
    }
}

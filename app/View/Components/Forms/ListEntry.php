<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class ListEntry extends Component
{
    public bool $lastEntry;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(bool $lastEntry)
    {
        $this->lastEntry = $lastEntry;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render(): \Illuminate\Contracts\View\View|string|\Closure|\Illuminate\View\View
    {
        return view('components.forms.list-entry');
    }
}

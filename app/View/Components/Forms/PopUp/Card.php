<?php

namespace App\View\Components\Forms\PopUp;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    #[\Override]
    public function render()
    {
        return view('components.forms.pop-up.card');
    }
}

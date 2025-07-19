<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    #[\Override]
    public function render(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        return view('layouts.guest');
    }
}

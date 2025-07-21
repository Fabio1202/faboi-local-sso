<?php

/** @noinspection PsalmGlobal */

namespace App\View\Components;

use Illuminate\View\Component;

/** @psalm-suppress UnusedClass */
class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    #[\Override]
    public function render(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        return view('layouts.app');
    }
}

<?php
/** @psalm-suppress UnusedClass */

namespace App\View\Components;

use Illuminate\View\Component;

class AuthLayout extends Component
{
    public string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    #[\Override]
    public function render()
    {
        return view('layouts.auth');
    }
}

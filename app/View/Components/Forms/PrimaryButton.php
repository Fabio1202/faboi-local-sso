<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class PrimaryButton extends Component
{
    public string $route;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $route)
    {
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    #[\Override]
    public function render()
    {
        return view('components.forms.primary-button');
    }
}

<?php

namespace App\View\Components\Roles;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowRole extends Component
{

    public $role;
    public $applications;

    /**
     * Create a new component instance.
     */
    public function __construct($role, $applications)
    {
        $this->role = $role;
        $this->applications = $applications;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.roles.show-role');
    }
}

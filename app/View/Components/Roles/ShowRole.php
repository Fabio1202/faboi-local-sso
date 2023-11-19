<?php

namespace App\View\Components\Roles;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowRole extends Component
{

    public $role;
    public $applications;
    public $users;

    /**
     * Create a new component instance.
     */
    public function __construct($role, $applications, $users)
    {
        $this->role = $role;
        $this->applications = $applications;
        $this->users = $users;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.roles.show-role');
    }
}

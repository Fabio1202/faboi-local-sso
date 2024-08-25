<?php

namespace App\View\Components\Roles;

use App\Models\Application;
use App\Models\Role;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ShowRole extends Component
{
    public Role $role;

    /**
     * @var Application[]|Collection
     */
    public array|Collection $applications;

    /**
     * @var Paginator
     */
    public Paginator $users;

    /**
     * Create a new component instance.
     *
     * @param  Application[]|Collection  $applications
     * @param  Paginator  $users
     */
    public function __construct(Role $role, array|Collection $applications, Paginator $users)
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

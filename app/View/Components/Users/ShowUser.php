<?php

namespace App\View\Components\Users;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ShowUser extends Component
{
    public User $user;

    /**
     * Create a new component instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    #[\Override]
    public function render(): View|Closure|string
    {
        return view('components.users.show-user');
    }
}

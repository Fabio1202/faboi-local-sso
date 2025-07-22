<?php

/** @noinspection ALL */

/**
 * @noinspection PhpStanGlobal
 *
 * @psalm-suppress all
 */

namespace App\Policies;

use App\Models\Application;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * @noinspection PhpStanGlobal
 *
 * @psalm-suppress all
 */
class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): void
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return void|true
     */
    public function view(User $user, Application $application)
    {
        if ($user->id == $application->owner_id) {
            return true;
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): void
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Application $application): void
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Application $application): void
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Application $application): void
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Application $application): void
    {
        //
    }
}

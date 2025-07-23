<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Client;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @noinspection PhpInconsistentReturnPointsInspection
     */
    public function boot(): void
    {
        Passport::useClientModel(Client::class);

        $this->registerPolicies();

        // Passport::hashClientSecrets();
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));

        // Before, check if the user has the permission to perform the action
        Gate::before(function ($user, $ability) {
            // If the user has the permission, allow the action
            if ($user->hasPermission($ability)) {
                return true;
            }

            // If the user is an admin, allow the action
            if ($user->hasRole('Admin')) {
                return true;
            }
        });
    }
}

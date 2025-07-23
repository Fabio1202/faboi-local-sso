<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Passport\Client as BaseClient;

/**
 * Class Client
 *
 * Represents a client application in the system.
 *
 * @property string $name The name of the client application.
 * @property string $redirect The redirect URI for the client application.
 * @property bool $first_party Indicates if the client is a first-party application.
 * @property Application $application The application this client belongs to.
 */
class Client extends BaseClient
{
    /**
     * Determine if the client should skip the authorization prompt.
     */
    #[\Override]
    public function skipsAuthorization(Authenticatable $user, array $scopes): bool
    {
        return $this->firstParty() || $this->application->first_party;
    }

    /**
     * Get the application that owns the client.
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}

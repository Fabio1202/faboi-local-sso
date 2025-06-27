<?php

namespace App\Models;

use Laravel\Passport\Client as BaseClient;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends BaseClient
{
    /**
     * Determine if the client should skip the authorization prompt.
     */
    public function skipsAuthorization(): bool
    {
        return $this->firstParty() || $this->application->first_party;
    }

    /**
     * Get the application that owns the client.
     *
     * @return BelongsTo<\App\Models\Application, $this>
     */
    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Passkey
 *
 * Represents a passkey in the system.
 *
 * @property string $id The unique identifier for the passkey.
 * @property string $user_id The ID of the user associated with the passkey.
 * @property string $credential_id The credential ID for the passkey.
 * @property string $public_key The public key associated with the passkey.
 * @property \Illuminate\Support\Carbon|null $created_at The timestamp when the passkey was created.
 * @property \Illuminate\Support\Carbon|null $updated_at The timestamp when the passkey was last updated.
 * @property \App\Models\User $user The user associated with the passkey.
 */
class Passkey extends Model {
    /**
     * @return BelongsTo<\App\Models\User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

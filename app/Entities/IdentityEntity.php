<?php

// app/Entities/IdentityEntity.php

namespace App\Entities;

use App\Models\User;
use League\OAuth2\Server\Entities\Traits\EntityTrait;
use OpenIDConnect\Claims\Traits\WithClaims;
use OpenIDConnect\Interfaces\IdentityEntityInterface;

class IdentityEntity implements IdentityEntityInterface
{
    use EntityTrait;
    use WithClaims;

    /**
     * The user to collect the additional information for
     */
    protected User $user;

    /**
     * The identity repository creates this entity and provides the user id
     *
     * @param  mixed  $identifier
     */
    public function setIdentifier($identifier): void
    {
        $this->identifier = $identifier;
        $this->user = User::where('id', $identifier)->firstOrFail();
    }

    /**
     * When building the id_token, this entity's claims are collected
     */
    #[\Override]
    public function getClaims(): array
    {
        return [
            'email' => $this->user->email,
        ];
    }
}

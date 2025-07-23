<?php

namespace App\Http\Middleware;

use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\Http\Middleware\CheckToken;

class AllowOnlyClientsAuthentication extends CheckToken
{
    #[\Override]
    protected function validateCredentials($token)
    {
        parent::validateCredentials($token);
        if ($token->user_id !== null) {
            throw new AuthenticationException;
        }
    }
}

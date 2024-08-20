<?php

namespace App\Http\Middleware;

use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;

class AllowOnlyClientsAuthentication extends CheckClientCredentials
{
    protected function validateCredentials($token)
    {
        parent::validateCredentials($token);
        if ($token->user_id !== null) {
            throw new AuthenticationException;
        }
    }
}

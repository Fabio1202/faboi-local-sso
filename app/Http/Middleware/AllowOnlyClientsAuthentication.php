<?php

namespace App\Http\Middleware;

use Laravel\Passport\Contracts\ScopeAuthorizable;
use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\Http\Middleware\CheckToken;
use Illuminate\Http\Request;

class AllowOnlyClientsAuthentication extends CheckToken
{
    #[\Override]
    protected function validate(ScopeAuthorizable $token, string ...$params): void
    {
        throw new AuthenticationException;

//        parent::validate($token, ...$params);
//        if ($token->user_id !== null) {
//            throw new AuthenticationException;
//        }
    }
}

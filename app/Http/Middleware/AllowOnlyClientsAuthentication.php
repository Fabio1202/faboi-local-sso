<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Passport\Exceptions\AuthenticationException;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Symfony\Component\HttpFoundation\Response;

class AllowOnlyClientsAuthentication extends CheckClientCredentials
{
    protected function validateCredentials($token)
    {
        parent::validateCredentials($token);
        if($token->user_id !== null) {
            throw new AuthenticationException;
        }
    }


}

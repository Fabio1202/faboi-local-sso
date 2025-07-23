<?php

namespace App\Http\Requests;

use App\Models\Application;
use App\Models\Client;
use Illuminate\Http\Request as BaseRequest;
use Laravel\Passport\Passport;
use Laravel\Passport\Token;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Plain;

class ClientRequest extends BaseRequest
{
    public function client(): ?Client
    {
        // todo: implement this function to return the client based on the request
        return null;

//        $bearerToken = request()->bearerToken();
//
//        /** @phpstan-ignore-next-line */
//        $tokenId = Configuration::forAsymmetricSigner(
//            new Sha256(),
//            InMemory::plainText(config('passport.private_key')),
//            InMemory::file(config('passport.public_key'))
//        )->parser()->parse($bearerToken)->claims()->get('jti');
//
//        /** @phpstan-ignore-next-line */
//        return Token::find($tokenId)->client;
    }

    public function application(): Application
    {
        return $this->client()->application;
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Application;
use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as BaseRequest;
use Laravel\Passport\Token;
use Lcobucci\JWT\Configuration;

class ClientRequest extends BaseRequest
{
    public function client() : Client|null {
        $bearerToken = request()->bearerToken();
        /** @noinspection PhpUndefinedMethodInspection */
        // @phpstan-ignore-next-line
        $tokenId = Configuration::forUnsecuredSigner()->parser()->parse($bearerToken)->claims()->get('jti');

        /** @var Client */
        return Token::find($tokenId)->client;
    }

    public function application() : Application {
        return $this->client()->application;
    }

}

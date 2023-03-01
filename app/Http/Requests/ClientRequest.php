<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as BaseRequest;
use Laravel\Passport\Token;
use Lcobucci\JWT\Configuration;

class ClientRequest extends BaseRequest
{
    public function client() {
        $bearerToken = request()->bearerToken();
        $tokenId = Configuration::forUnsecuredSigner()->parser()->parse($bearerToken)->claims()->get('jti');
        return Token::find($tokenId)->client;
    }

    public function application() {
        return $this->client()->application;
    }

}

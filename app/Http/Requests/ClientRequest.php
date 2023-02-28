<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request as BaseRequest;

class ClientRequest extends BaseRequest
{
    public function client() {
        return Client::find($this->get('client_id'));
    }

    public function application() {
        return $this->client()->application;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Passport\ClientRepository;

class ClientController extends Controller
{
    public function create(Application $application) {
        return view('clients.create', compact('application'));
    }

    public function store() {
        $values = request()->validate([
            'name' => 'required',
            'redirect' => 'required|url',
            'type' => 'required|in:password,authorization',
            'application_id' => 'required|exists:applications,id',
        ]);

        if($values['type'] == 'password') {
            return redirect()->back()->withInput()->withErrors([
                'type' => 'Password grant type is not yet supported.'
            ]);
        }

        $client = Client::create([
            'name' => $values['name'],
            'redirect' => $values['redirect'],
            'secret' => $values['type'] != 'password' ? '' : Str::random(40),
            'personal_access_client' => false,
            'password_client' => $values['type'] == 'password',
            'revoked' => false,
            'application_id' => $values['application_id']
        ]);

        return redirect()->route('applications.show', $values['application_id']);

    }

    public function destroy(Client $client) {
        $client->delete();
        return redirect()->route('applications.show', $client->application_id);
    }
}

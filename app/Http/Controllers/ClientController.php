<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Client;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function create(Application $application)
    {
        return view('clients.create', compact('application'));
    }

    public function store()
    {
        $values = request()->validate([
            'name' => 'required',
            'redirect' => 'required|url',
            'type' => 'required|in:password,authorization,server',
            'application_id' => 'required|exists:applications,id',
        ]);

        if ($values['type'] == 'password') {
            return redirect()->back()->withInput()->withErrors([
                'type' => 'Password grant type is not yet supported.',
            ]);
        }

        $client = Client::create([
            'name' => $values['name'],
            'redirect' => $values['redirect'],
            'secret' => $values['type'] == 'authorization' ? '' : Str::random(40),
            'personal_access_client' => false,
            'password_client' => $values['type'] == 'password',
            'revoked' => false,
            'application_id' => $values['application_id'],
        ]);

        if ($values['type'] == 'authorization') {
            return redirect()->route('applications.show', $values['application_id']);
        }
        session()->flash('client', $client);

        // Return redirect to view to show client secret
        return redirect()->route('clients.show-secret');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('applications.show', $client->application_id);
    }

    public function showSecret()
    {
        $client = session()->pull('client');

        if (! $client) {
            return redirect()->route('applications.index');
        }

        return view('clients.show-secret', compact('client'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Support\Facades\Gate;

/** @psalm-suppress UnusedClass */
class ApplicationController extends Controller
{
    public function index(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        // Show paginated list of applications
        return view('applications.index', [
            'applications' => \App\Models\Application::paginate(10),
        ]);
    }

    public function show(\App\Models\Application $application): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        Gate::authorize('view', $application);

        // Show application details
        return view('applications.show', [
            'application' => $application->load('clients', 'permissionGroups'),
        ]);
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        $req = request()->validate([
            'name' => 'required',
            'description' => 'string|nullable',
            'first_party' => '',
            'uses_role_system' => '',
        ]);

        $req['first_party'] = ($req['first_party'] ?? '') == 'on';

        $req['uses_role_system'] = ($req['uses_role_system'] ?? '') == 'on';

        $req['owner_id'] = auth()->user()->id;

        Application::create($req);

        return redirect()->route('applications.index');
    }

    public function create(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        return view('applications.create');
    }
}

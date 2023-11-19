<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(20);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create', [
            'applications' => Application::all()
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|unique:roles',
            'description' => 'string'
        ]);

        $role = Role::create($data);

        $role->permissions()->attach(request()->get('permissions'));

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }
}

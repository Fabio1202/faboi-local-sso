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
            'applications' => Application::all(),
            'role' => new Role()
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

    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role,
            'applications' => Application::all()
        ]);
    }

    public function update(Role $role)
    {
        $data = request()->validate([
            'name' => 'required|string',
            'description' => 'string'
        ]);

        $role->update($data);

        $role->permissions()->sync(request()->get('permissions'));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }
}

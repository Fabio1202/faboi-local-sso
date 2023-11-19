<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Role;
use App\Models\User;

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
            'role' => new Role(),
            'users' => User::paginate(10)
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

        $role->users()->attach(request()->get('users'));

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function show(Role $role)
    {
        return view('roles.show', [
            'role' => $role,
            'applications' => Application::all(),
            'users' => User::paginate(10)
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

        $role->users()->sync(request()->get('users'));

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }
}

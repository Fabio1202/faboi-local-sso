<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Return view with paginated users
        return view('users.view-all', [
            'users' => User::paginate(20),
        ]);
    }

    public function create()
    {
        return view('users.create', []);
    }
}

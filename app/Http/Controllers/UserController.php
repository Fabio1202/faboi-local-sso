<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        // Return view with paginated users
        return view('users.view-all', [
            'users' => User::paginate(20),
        ]);
    }

    public function create(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        return view('users.create', []);
    }

    public function show(User $user): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        return view('users.index', [
            'user' => $user,
        ]);
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {
        // Validate request
        $validated = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Check if mail is unique
        if (User::where('email', $validated['email'])->exists()) {
            return back()->withInput()->withErrors(['email' => 'Email already exists']);
        }

        // Create user
        $user = User::create($validated);

        // Get roles
        $roles = request()->get('roles');
        $user->roles()->attach($roles);

        // Redirect to users index
        return redirect()->route('users.show', $user->id);
    }

    public function activate(): \Illuminate\View\View|\Illuminate\Contracts\View\View
    {
        $user = User::where('uuid', request()->get('uuid'))->firstOrFail();

        return view('users.activate', [
            'user' => $user,
        ]);
    }

    public function postActivate(): \Illuminate\Http\RedirectResponse
    {
        // Validate request
        $validated = request()->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        try {
            $user = User::where('uuid', Crypt::decryptString(request()->get('uuid')))->firstOrFail();
        } catch (DecryptException $e) {
            return back()->withErrors(['name' => 'Something sketchy is going on']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $user->sendEmailVerificationNotification();

        return redirect()->route('login');

    }

    public function update(User $user): \Illuminate\Http\RedirectResponse
    {
        // Validate request
        $validated = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Check if mail is unique
        if (User::where('email', $validated['email'])->where('id', '!=', $user->id)->exists()) {
            return back()->withInput()->withErrors(['email' => 'Email already exists']);
        }

        // Update user
        $user->update($validated);

        // Get roles
        $roles = request()->get('roles');
        $user->roles()->sync($roles);

        // Redirect to users index
        return redirect()->route('users.show', $user->id);
    }
}

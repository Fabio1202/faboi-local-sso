<?php

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

if(config('app.env') == 'local') {
    Route::get('/test-auth-screen', function () {
        return view('vendor.passport.authorize', [
            'client' =>  new Client([
                'name' => 'Test Client',
                'redirect' => 'http://localhost:8000/callback',
                'id' => 1,
                'application' => \App\Models\Application::first(),
            ]),
            'scopes' => [],
            'user' => User::find(1),
            'request' => new \Illuminate\Http\Request([
                'client_id' => 1,
                'redirect_uri' => 'http://localhost:8000/callback',
                'response_type' => 'code',
                'scope' => '',
                'state' => ''
            ]),
            'authToken' => 'test-token',
        ]);
    });
}

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::group(['prefix' => 'applications'], function () {
        Route::get('/', [App\Http\Controllers\ApplicationController::class, 'index'])->name('applications.index');
        Route::get('/create', [App\Http\Controllers\ApplicationController::class, 'create'])->name('applications.create');
        Route::post('/', [App\Http\Controllers\ApplicationController::class, 'store'])->name('applications.store');
        Route::get('/{application:id}', [App\Http\Controllers\ApplicationController::class, 'show'])->name('applications.show');
        Route::get('/{application}/clients/create', [App\Http\Controllers\ClientController::class, 'create'])->name('clients.create');
    });

    Route::group(['prefix' => 'clients'], function () {
        Route::post('/', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
        Route::delete('/{client}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('clients.destroy')->middleware('password.confirm');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
    });
});

require __DIR__.'/auth.php';

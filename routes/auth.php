<?php

use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware(['guest:'.config('fortify.guard')])
    ->name('password.email');

Route::get('/oauth/userinfo', function (Request $request) {
    $user = $request->user(); // Authentifizierter User aus Passport

    return response()->json([
        // Pflicht-Claim: Subjekt-Identifier
        'sub' => (string) $user->getAuthIdentifier(),
        // optionale Standard-Claims:
        'name' => $user->name,
        'preferred_username' => $user->username ?? null,
        'email' => $user->email,
        'email_verified' => (bool) $user->hasVerifiedEmail(),
        'updated_at' => $user->updated_at?->toIso8601String(),
        // eigene Claims:
        // 'roles'           => $user->roles->pluck('name'),
    ], 200, ['Cache-Control' => 'no-store', 'Pragma' => 'no-cache']);
})->middleware('auth:api')->name('openid.userinfo');

<?php

use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware(['guest:'.config('fortify.guard')])
    ->name('password.email');

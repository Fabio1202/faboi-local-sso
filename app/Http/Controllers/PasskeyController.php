<?php

namespace App\Http\Controllers;

use App\Services\Auth\PasskeyService;

class PasskeyController extends Controller
{
    public function generateAuthenticationOptions(PasskeyService $passkeyService) {
        return response()->json($passkeyService->generateCredentialCreateOptions());
    }

    public function store(PasskeyService $passkeyService) {
        return null;
    }
}

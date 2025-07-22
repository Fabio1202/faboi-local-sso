<?php

namespace App\Http\Controllers;

use App\Services\Auth\PasskeyService;

class PasskeyController extends Controller
{
    public function generateRegistrationOptions(PasskeyService $passkeyService): \Illuminate\Http\JsonResponse
    {
        return response()->json($passkeyService->generateCredentialCreateOptions());
    }

    public function validateRegistration(PasskeyService $passkeyService): \Illuminate\Http\JsonResponse
    {
        return response()->json($passkeyService->verifyRegistration());
    }

    public function generateAuthenticationOptions(PasskeyService $passkeyService): \Illuminate\Http\JsonResponse
    {
        return response()->json($passkeyService->generateCredentialAuthorizationOptions());
    }

    public function validateAuthentication(PasskeyService $passkeyService): \Illuminate\Http\JsonResponse
    {
        return response()->json($passkeyService->verifyAuthorization());
    }
}

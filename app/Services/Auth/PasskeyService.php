<?php

namespace App\Services\Auth;

use Webauthn\AuthenticatorSelectionCriteria;
use Webauthn\PublicKeyCredentialCreationOptions;
use Webauthn\PublicKeyCredentialRpEntity;
use Webauthn\PublicKeyCredentialUserEntity;

class PasskeyService
{
    public function __construct()
    {
    }

    public function generateCredentialCreateOptions() {
        $rpEntity = PublicKeyCredentialRpEntity::create(
            'Faboi Auth',
            'auth.faboi.de',
            null
        );

        $userEntity = PublicKeyCredentialUserEntity::create(
            request()->user()->name,
            request()->user()->uuid,
            request()->user()->name,
            null
        );

        $authenticatorSelectionCriteria = AuthenticatorSelectionCriteria::create(
            residentKey: AuthenticatorSelectionCriteria::RESIDENT_KEY_REQUIREMENT_REQUIRED,
        );

        $challenge = base64_encode(random_bytes(16));

        $response = PublicKeyCredentialCreationOptions::create(
            $rpEntity,
            $userEntity,
            $challenge,
            authenticatorSelection: $authenticatorSelectionCriteria,
        );

        session()->put('passkey.create.options', $response);

        return $response;
    }
}

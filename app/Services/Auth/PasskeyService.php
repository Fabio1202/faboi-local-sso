<?php

namespace App\Services\Auth;

use App\Models\Passkey;
use Symfony\Component\Serializer\Serializer;
use Webauthn\AttestationStatement\AttestationStatementSupportManager;
use Webauthn\AttestationStatement\NoneAttestationStatementSupport;
use Webauthn\AuthenticatorAssertionResponse;
use Webauthn\AuthenticatorAssertionResponseValidator;
use Webauthn\AuthenticatorAttestationResponse;
use Webauthn\AuthenticatorAttestationResponseValidator;
use Webauthn\AuthenticatorSelectionCriteria;
use Webauthn\CeremonyStep\CeremonyStepManagerFactory;
use Webauthn\Denormalizer\WebauthnSerializerFactory;
use Webauthn\PublicKeyCredential;
use Webauthn\PublicKeyCredentialCreationOptions;
use Webauthn\PublicKeyCredentialRequestOptions;
use Webauthn\PublicKeyCredentialRpEntity;
use Webauthn\PublicKeyCredentialSource;
use Webauthn\PublicKeyCredentialUserEntity;

class PasskeyService
{
    private Serializer $serializer;

    private AuthenticatorAttestationResponseValidator $authenticatorAttestationResponseValidator;

    private AuthenticatorAssertionResponseValidator $authenticatorAssertionResponseValidator;

    public function __construct()
    {
        $attestationStatementSupportManager = AttestationStatementSupportManager::create();
        $attestationStatementSupportManager->add(new NoneAttestationStatementSupport);

        $factory = new WebauthnSerializerFactory($attestationStatementSupportManager);
        // @var Serializer
        $this->serializer = $factory->create();

        $csmFactory = new CeremonyStepManagerFactory;
        $csmFactory->setSecuredRelyingPartyId(['localhost']);

        $creationCSM = $csmFactory->creationCeremony();
        $requestCSM = $csmFactory->requestCeremony();

        $this->authenticatorAttestationResponseValidator = AuthenticatorAttestationResponseValidator::create(
            $creationCSM
        );

        $this->authenticatorAttestationResponseValidator->setLogger(app('log'));

        $this->authenticatorAssertionResponseValidator = AuthenticatorAssertionResponseValidator::create(
            $requestCSM
        );
    }

    public function generateCredentialCreateOptions(): string
    {
        $rpEntity = PublicKeyCredentialRpEntity::create(
            config('app.name'),
            str_replace(['http://', 'https://'], '', config('app.url')),
            null
        );

        $userEntity = PublicKeyCredentialUserEntity::create(
            request()->user()->name,
            request()->user()->uuid,
            request()->user()->name,
            null
        );

        $authenticatorSelectionCriteria = AuthenticatorSelectionCriteria::create(
            authenticatorAttachment: AuthenticatorSelectionCriteria::AUTHENTICATOR_ATTACHMENT_NO_PREFERENCE,
            userVerification: AuthenticatorSelectionCriteria::USER_VERIFICATION_REQUIREMENT_REQUIRED,
            residentKey: AuthenticatorSelectionCriteria::RESIDENT_KEY_REQUIREMENT_REQUIRED,
        );

        $challenge = random_bytes(30);

        $response = PublicKeyCredentialCreationOptions::create(
            $rpEntity,
            $userEntity,
            $challenge,
            authenticatorSelection: $authenticatorSelectionCriteria,
            attestation: PublicKeyCredentialCreationOptions::ATTESTATION_CONVEYANCE_PREFERENCE_NONE
        );

        session()->put('passkey.create.options', $response);

        return $this->serializer->normalize($response);
    }

    public function verifyRegistration(): false|string
    {

        // Map request()->all() to remove all \ from JSON
        $json = request()->all();

        //dd(request()->getContent());

        $publicKeyCredential = $this->serializer->denormalize(
            $json,
            PublicKeyCredential::class,
            'json'
        );

        $publicKeyCredentialCreationOptions = session()->pull('passkey.create.options');

        //dd($publicKeyCredential);

        if ($publicKeyCredential->response instanceof AuthenticatorAttestationResponse) {
            $authenticatorAttestationResponse = $publicKeyCredential->response;
            $publicKeyCredentialSource = $this->authenticatorAttestationResponseValidator->check(
                $authenticatorAttestationResponse,
                $publicKeyCredentialCreationOptions,
                //request()
                str_replace(['http://', 'https://'], '', config('app.url'))
            );

            // Store the key in the database

            $key = new Passkey;
            $key->keySource = json_encode($this->serializer->normalize($publicKeyCredentialSource));
            $key->aaguid = request()->get('id');
            auth()->user()->passkeys()->save($key);

            //return $this->serializer->normalize($publicKeyCredentialSource);
            return json_encode(['success' => true]);
        }

        return json_encode(['success' => false]);
    }

    public function generateCredentialAuthorizationOptions(): string
    {
        $rpEntity = str_replace(['http://', 'https://'], '', config('app.url'));

        $challenge = random_bytes(30);

        $response = PublicKeyCredentialRequestOptions::create(
            $challenge,
            $rpEntity,
            userVerification: PublicKeyCredentialRequestOptions::USER_VERIFICATION_REQUIREMENT_REQUIRED
        );

        session()->put('passkey.request.options', $response);

        return $this->serializer->normalize($response);
    }

    public function verifyAuthorization(): array
    {
        $json = request()->all();

        $publicKeyCredential = $this->serializer->denormalize(
            $json,
            PublicKeyCredential::class,
            'json'
        );

        $publicKeyCredentialRequestOptions = session()->pull('passkey.request.options');

        if ($publicKeyCredential->response instanceof AuthenticatorAssertionResponse) {
            $authenticatorAssertionResponse = $publicKeyCredential->response;

            $passkey = Passkey::where('aaguid', request()->get('id'))->firstOrFail();

            $originalKey = $this->serializer->denormalize(json_decode($passkey->keySource, associative: true), PublicKeyCredentialSource::class, 'json');

            $publicKeyCredentialSource = $this->authenticatorAssertionResponseValidator->check(
                $originalKey,
                $authenticatorAssertionResponse,
                $publicKeyCredentialRequestOptions,
                str_replace(['http://', 'https://'], '', config('app.url')),
                null
            );

            $passkey->keySource = json_encode($this->serializer->normalize($publicKeyCredentialSource));
            $passkey->save();

            auth()->login($passkey->user);

            return ['success' => true];
        }

        return ['success' => false];
    }
}

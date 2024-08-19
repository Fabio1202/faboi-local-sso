<?php

namespace App\Services\Auth;

use Symfony\Component\Serializer\Encoder\JsonEncode;
use Webauthn\AttestationStatement\AttestationStatementSupportManager;
use Webauthn\AttestationStatement\NoneAttestationStatementSupport;
use Webauthn\AuthenticatorAssertionResponseValidator;
use Webauthn\AuthenticatorAttestationResponse;
use Webauthn\AuthenticatorAttestationResponseValidator;
use Webauthn\AuthenticatorSelectionCriteria;
use Webauthn\CeremonyStep\CeremonyStepManagerFactory;
use Webauthn\Denormalizer\WebauthnSerializerFactory;
use Webauthn\PublicKeyCredential;
use Webauthn\PublicKeyCredentialCreationOptions;
use Webauthn\PublicKeyCredentialRpEntity;
use Webauthn\PublicKeyCredentialUserEntity;

class PasskeyService
{

    private $serializer;
    private $authenticatorAttestationResponseValidator;
    private $authenticatorAssertionResponseValidator;

    public function __construct()
    {
        $attestationStatementSupportManager = AttestationStatementSupportManager::create();
        $attestationStatementSupportManager->add(new NoneAttestationStatementSupport());

        $factory = new WebauthnSerializerFactory($attestationStatementSupportManager);
        $this->serializer = $factory->create();

        $csmFactory = new CeremonyStepManagerFactory();
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

    public function generateCredentialCreateOptions() {
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
            userVerification: AuthenticatorSelectionCriteria::USER_VERIFICATION_REQUIREMENT_PREFERRED,
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

        $response = $this->serializer->normalize($response);



        return $response;
    }

    public function verifyRegistration()
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

            return $this->serializer->normalize($publicKeyCredentialSource);
        }
        return "{}";
    }
}

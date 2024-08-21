import './bootstrap';
import '@fortawesome/fontawesome-free/scss/fontawesome.scss';
import '@fortawesome/fontawesome-free/scss/brands.scss';
import '@fortawesome/fontawesome-free/scss/regular.scss';
import '@fortawesome/fontawesome-free/scss/solid.scss';
import '@fortawesome/fontawesome-free/scss/v4-shims.scss';
import {startAuthentication, startRegistration} from "@simplewebauthn/browser";

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.registerPasskey = (csrf) => {
    fetch("/passkeys/generate-registration-options")
    .then(res => res.json())
    .then(data => {
        delete data.attestation
        delete data.authenticatorSelection.authenticatorAttachment
        startRegistration(data)
        .then(res => {
            fetch("/passkeys/verify-registration", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf,
                    "Accept": "application/json"
                },
                body: JSON.stringify(res)
            })
            .then(res => res.json())
            .then(data => {
                console.log(data)
            })
        })
        .catch(err => {
            console.log(err)
        });
    });
}

window.authenticatePasskey = (csrf, bool = false) => {
    fetch("/passkeys/generate-authentication-options")
    .then(res => res.json())
    .then(data => {
        startAuthentication(data, bool)
        .then(res => {
            fetch("/passkeys/verify-authentication", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf,
                    "Accept": "application/json"
                },
                body: JSON.stringify(res)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    window.location.href = data.redirect;
                }
            })
        })
        .catch(err => {
            console.log(err)
        });
    });
}


<?php

namespace Tests\Feature;

use App\Services\Auth\PasskeyService;
use Tests\TestCase;

class PasskeyServiceTest extends TestCase
{
    public function test_it_can_be_initialized_for_the_configured_origin(): void
    {
        config()->set('app.url', 'https://sso.example.test');

        $this->assertInstanceOf(PasskeyService::class, app(PasskeyService::class));
    }
}

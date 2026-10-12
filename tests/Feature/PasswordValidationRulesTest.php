<?php

namespace Tests\Feature;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class PasswordValidationRulesTest extends TestCase
{
    public function test_password_rules_preserve_the_eight_character_minimum(): void
    {
        $subject = new class
        {
            use PasswordValidationRules;

            public function rules(): array
            {
                return $this->passwordRules();
            }
        };

        $tooShort = Validator::make([
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ], ['password' => $subject->rules()]);

        $valid = Validator::make([
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ], ['password' => $subject->rules()]);

        $this->assertTrue($tooShort->fails());
        $this->assertTrue($valid->passes());
    }
}

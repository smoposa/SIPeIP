<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que el registro público
     * está deshabilitado en SIPeIP.
     */
    public function test_registration_is_not_available(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(404);
    }
}
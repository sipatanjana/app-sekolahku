<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_login_dengan_data_kosong(): void
    {
        $data = [
            'email' => '',
            'password' => '',
        ];

        $response = $this->post('/api/auth', $data, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'email' => 'The email id field is required.',
            'password' => 'The password date field is required.',
        ]);
    }
    
    public function test_login_dengan_data_email_yang_salah(): void
    {
        $data = [
            'email' => 'aisudhias',
            'password' => 'aisudhias',
        ];

        $response = $this->post('/api/auth', $data, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'email' => 'The email field must be a valid email address',
        ]);
    }
    
    public function test_login_dengan_data_email_yang_tidak_ada(): void
    {
        $data = [
            'email' => 'andi@andi-satu.com',
            'password' => 'aisudhias',
        ];

        $response = $this->post('/api/auth', $data, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'email' => 'The selected email is invalid.',
        ]);
    }
    
    public function test_login_dengan_data_benar(): void
    {
        $data = [
            'email' => 'andi@andi.com',
            'password' => '12345',
        ];

        $response = $this->post('/api/auth', $data, ['Accept' => 'application/json']);

        $response->assertStatus(200);
    }
}

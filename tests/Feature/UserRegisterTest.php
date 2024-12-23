<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    public function test_register_dengan_data_kosong(): void
    {
        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
        ];

        $response = $this->post('/api/user', $data, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'name' => 'The name id field is required.',
            'email' => 'The email id field is required.',
            'password' => 'The password date field is required.',
        ]);
    }
    
    public function test_register_dengan_data_email_yang_salah(): void
    {
        $data = [
            'name' => 'Tono',
            'email' => 'aisudhias',
            'password' => '1231241',
        ];

        $response = $this->post('/api/user', $data, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'email' => 'The email field must be a valid email address',
        ]);
    }
    
    public function test_register_dengan_data_email_yang_sudah_ada(): void
    {
        $data = [
            'name' => 'Tono',
            'email' => 'andi@andi.com',
            'password' => 'aisudhias',
        ];

        $response = $this->post('/api/user', $data, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $this->assertDatabaseMissing('users', [
            'email' => 'The email has already been taken.',
        ]);
    }
    
    public function test_register_dengan_data_benar(): void
    {
        $data = [
            'name' => 'Tono',
            'email' => 'tono@tono.com',
            'password' => '1234578askdjask',
        ];

        $response = $this->post('/api/user', $data, ['Accept' => 'application/json']);

        $response->assertStatus(200);
    }
}

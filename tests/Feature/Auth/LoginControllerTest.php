<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function validCredentials()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);


        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User logged in successfully',
            ])
            ->assertJsonStructure(['token']);
    }

    /** @test */
    public function invalidCredentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'testusers@etest.com',
            'password' => 'wrongpasswordtest',
        ]);


        $response->assertStatus(401)
            ->assertJson([
                'status' => false,
                'message' => 'Email & Password do not records.',
            ]);
    }

    /** @test */
    public function missingCredentials()
    {

        $response = $this->postJson('/api/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'status' => false,
                'message' => 'Validation error',
            ])
            ->assertJsonStructure(['errors']);
    }

    /** @test */
    public function unexpectedErrors()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/login', [
            'email' => 'trigger-error@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(500)
            ->assertJson([
                'status' => false,
                'message' => 'An error occurred',
            ]);
    }

}


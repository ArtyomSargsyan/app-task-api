<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function validData()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'User Created Successfully',
            ])
            ->assertJsonStructure(['token']);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);

    }

    /** @test */
    public function invalidEmail()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => 'validation error',
            ])
            ->assertJsonStructure(['errors']);
    }

    /** @test */
    public function missingPasswordConfirmation()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'DifferentPassword1!',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => 'validation error',
            ])
            ->assertJsonStructure(['errors']);
    }

    /** @test */
    public function registrationFailsPassword()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Narek Gevorgyan',
            'email' => 'gevorgyan@example.com',
            'password' => 'short',
            'password_confirmation' => 'short',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => 'validation error',
            ])
            ->assertJsonStructure(['errors']);
    }

    /** @test */
    public function duplicateEmail()
    {
        User::factory()->create([
            'email' => 'gevorgyan@example.com',
        ]);

        $response = $this->postJson('/api/register', [
            'name' => 'Narek Gevorgyan',
            'email' => 'gevorgyan@example.com',
            'password' => 'Password1!',
            'password_confirmation' => 'Password1!',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'status' => false,
                'message' => 'validation error',
            ])
            ->assertJsonStructure(['errors']);
    }
}

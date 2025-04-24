<?php

namespace Tests\Unit;

use App\Services\AuthService;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthServiceTest extends TestCase
{
    use RefreshDatabase;

    private AuthService $authService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authService = new AuthService();
    }

    public function test_can_register_user()
    {
        // Arrange
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ];

        // Act
        $result = $this->authService->register($userData);

        // Assert
        $this->assertIsArray($result);
        $this->assertArrayHasKey('user', $result);
        $this->assertInstanceOf(User::class, $result['user']);
        $this->assertEquals($userData['name'], $result['user']->name);
        $this->assertEquals($userData['email'], $result['user']->email);
        $this->assertTrue(Hash::check($userData['password'], $result['user']->password));
    }

    public function test_can_login_user()
    {
        // Arrange
        $password = 'password123';
        $user = User::factory()->create([
            'password' => Hash::make($password)
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => $password
        ];

        // Act
        $result = $this->authService->login($credentials);

        // Assert
        $this->assertIsArray($result);
        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('access_token', $result);
        $this->assertInstanceOf(User::class, $result['user']);
    }

    public function test_cannot_login_with_invalid_credentials()
    {
        // Arrange
        $user = User::factory()->create([
            'password' => Hash::make('password123')
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => 'wrong_password'
        ];

        // Act
        $result = $this->authService->login($credentials);

        // Assert
        $this->assertNull($result);
    }

    public function test_can_logout_user()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $result = $this->authService->logout();

        // Assert
        $this->assertNull($result);
        Auth::logout();
        $this->assertGuest();
    }

    public function test_can_get_current_user()
    {
        // Arrange
        $user = User::factory()->create();
        $this->actingAs($user);

        // Act
        $currentUser = auth()->user();

        // Assert
        $this->assertInstanceOf(User::class, $currentUser);
        $this->assertEquals($user->id, $currentUser->id);
        $this->assertEquals($user->name, $currentUser->name);
        $this->assertEquals($user->email, $currentUser->email);
    }
} 
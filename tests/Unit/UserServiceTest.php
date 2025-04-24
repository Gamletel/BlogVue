<?php

namespace Tests\Unit;

use App\Services\UserService;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Requests\User\UserUpdateRequest;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    private UserService $userService;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
        $this->userService = new UserService($this->userRepository);
    }

    public function test_can_create_user()
    {
        // Arrange
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123'
        ];

        // Act
        $user = $this->userService->store($userData);

        // Assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
        $this->assertTrue(Hash::check($userData['password'], $user->password));
    }

    public function test_can_update_user()
    {
        // Arrange
        $user = User::factory()->create();
        $request = new UserUpdateRequest();
        $request->merge([
            'name' => 'Updated Name',
            'email' => 'updated@example.com'
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id
        ]);

        $request->setValidator($validator);

        // Act
        $updatedUser = $this->userService->update($request, $user->id);

        // Assert
        $this->assertEquals($request->name, $updatedUser->name);
        $this->assertEquals($request->email, $updatedUser->email);
    }

    public function test_can_delete_user()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $result = $this->userService->destroy($user->id);

        // Assert
        $this->assertTrue($result > 0);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_can_get_user_by_id()
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $foundUser = $this->userService->show($user->id);

        // Assert
        $this->assertInstanceOf(User::class, $foundUser);
        $this->assertEquals($user->id, $foundUser->id);
        $this->assertEquals($user->name, $foundUser->name);
        $this->assertEquals($user->email, $foundUser->email);
    }

    public function test_can_get_all_users()
    {
        // Arrange
        User::factory()->count(3)->create();

        // Act
        $users = $this->userService->all();

        // Assert
        $this->assertCount(3, $users);
        $this->assertContainsOnlyInstancesOf(User::class, $users);
    }
} 
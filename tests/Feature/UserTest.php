<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test users array json.
     */
    public function test_users_array(): void
    {
        $users = User::factory()->count(10)->create();
        $response = $this->getJson(route('users.index'));

        $response->assertStatus(200)
            ->assertJsonCount(10);
    }


    /**
     * Test users empty array json
     */
    public function test_users_empty_array(): void
    {
        $response = $this->getJson(route('users.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0);
    }

    /**
     * Test users show json
     */
    public function test_users_show_json(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson(route('users.show', ['id' => $user->id]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }

    /**
     * Test users update some fields
     */
    public function test_users_update_name_and_email(): void
    {
        $user = User::factory()->create();

        $updatedData = [
            'name' => fake()->name,
            'email' => fake()->email,
        ];

        $response = $this->postJson(route('users.update', ['id' => $user->id]), $updatedData);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'user' => [
                    'id' => $user->id,
                    'name' => $updatedData['name'],
                    'email' => $updatedData['email'],
                    'avatar_path' => $user->avatar,
                ],
            ]);
    }
}

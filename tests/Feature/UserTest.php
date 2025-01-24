<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;


    public function test_api_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson(route('api.user'));

        $response->assertStatus(200);
    }

    public function test_api_users_list(): void
    {
        $users = User::factory()->count(3)->create();
        $response = $this->getJson(route('api.users.index'));

        $response->assertStatus(200)->assertJsonStructure([
            '*'=>[
                "id",
                "name",
                "email",
            ]
        ]);
    }
}

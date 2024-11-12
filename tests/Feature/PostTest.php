<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test posts array.
     */
    public function test_posts_array(): void
    {
        $posts = Post::factory()->count(10)->create();
        $response = $this->getJson(route('posts.index'));

        $response->assertStatus(200)
            ->assertJsonCount(10);
    }

    /**
     * Test posts empty array.
     */
    public function test_posts_empty_array(): void
    {
        $response = $this->getJson(route('posts.index'));

        $response->assertStatus(200)
            ->assertJsonCount(0);
    }

    public function test_post_show(): void
    {
        $user = User::factory()->create([
            'id' => 1,
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);

        $post = Post::factory()->create();

        $post->user_id = 1;
        $post->save();

        $response = $this->getJson(route('posts.show', ['id' => $post->id]));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'post' => $post,
            ])
            ->assertJsonFragment([
                'creator' => $user,
            ]);
    }
}

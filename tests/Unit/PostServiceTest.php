<?php

namespace Tests\Unit;

use App\Services\PostService;
use App\Services\UserService;
use App\Repositories\PostRepository;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostServiceTest extends TestCase
{
    use RefreshDatabase;

    private PostService $postService;
    private PostRepository $postRepository;
    private UserService $userService;
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->postRepository = new PostRepository();
        $this->userService = new UserService(new \App\Repositories\UserRepository());
        $this->postService = new PostService($this->postRepository, $this->userService);
        $this->user = User::factory()->create();
    }

    public function test_can_create_post()
    {
        // Arrange
        $postData = [
            'title' => 'Test Post',
            'description' => 'Test Description',
            'text' => 'Test Content',
            'user_id' => $this->user->id
        ];

        // Act
        $post = $this->postService->store($postData);

        // Assert
        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals($postData['title'], $post->title);
        $this->assertEquals($postData['description'], $post->description);
        $this->assertEquals($postData['text'], $post->text);
        $this->assertEquals($postData['user_id'], $post->user_id);
    }

    public function test_can_update_post()
    {
        // Arrange
        $post = Post::factory()->create(['user_id' => $this->user->id]);
        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'text' => 'Updated Content'
        ];

        // Act
        $updatedPost = $this->postService->update($updateData, $post->id);

        // Assert
        $this->assertEquals($updateData['title'], $updatedPost->title);
        $this->assertEquals($updateData['description'], $updatedPost->description);
        $this->assertEquals($updateData['text'], $updatedPost->text);
    }

    public function test_can_delete_post()
    {
        // Arrange
        $post = Post::factory()->create(['user_id' => $this->user->id]);

        // Act
        $result = $this->postService->delete($post->id);

        // Assert
        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_can_get_post_by_id()
    {
        // Arrange
        $post = Post::factory()->create(['user_id' => $this->user->id]);

        // Act
        $result = $this->postService->show($post->id);

        // Assert
        $this->assertIsArray($result);
        $this->assertArrayHasKey('post', $result);
        $this->assertInstanceOf(Post::class, $result['post']);
        $this->assertEquals($post->id, $result['post']->id);
        $this->assertEquals($post->title, $result['post']->title);
    }

    public function test_can_get_all_posts()
    {
        // Arrange
        Post::factory()->count(3)->create(['user_id' => $this->user->id]);

        // Act
        $posts = $this->postService->all();

        // Assert
        $this->assertCount(3, $posts);
        $this->assertContainsOnlyInstancesOf(Post::class, $posts);
    }
} 
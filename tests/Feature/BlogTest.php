<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testBlogPageIsAccessible(): void
    {
        $response = $this->get(route('posts.index'));

        $response->assertStatus(200);
    }

    public function testBlogPostsPageContainsPosts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('posts.index'));
        $response->assertSee($post->title);
    }

    public function testBlogPostPageIsAccessible()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('posts.show', $post));

        $response->assertOk();
    }
}

<?php

namespace Tests\Feature;

use App\Http\Livewire\Detail;
use App\Http\Livewire\EditPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Http\Livewire\NewPost;
use App\Models\User;
use App\Models\Post;
use Livewire\Livewire;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * Test if guest user can create a post
     *
     * @return void
     */
    function test_can_guest_create_post()
    {

        $post = Post::factory()->make();
        Livewire::test(NewPost::class)
            ->set('post', $post)
            ->call('save')
            ->assertForbidden();

    }

    /**
     * Test if user can create a post
     *
     * @return void
     */
    function test_can_create_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $post = Post::factory()->make();
        Livewire::test(NewPost::class)
            ->set('post', $post)
            ->call('save');

        $this->assertTrue(Post::where('title', $post->title)->exists());

    }

    /**
     * Test if user can update others posts
     *
     * @return void
     */
    function test_can_update_others_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $post = Post::factory()->make();
        Livewire::test(NewPost::class)
            ->set('post', $post)
            ->call('save');

        $user1 = User::factory()->create();
        $post = Post::where('title', $post->title)->first();
        $this->actingAs($user1);

        Livewire::test(EditPost::class, [
            'id' => $post->id
        ])
            ->set('post.title', $post->title)
            ->set('post.body', $post->body)
            ->set('post.category', $post->category)
            ->set('post.summary', $post->summery)
            ->call('save')
            ->assertForbidden();
    }

    /**
     * Test if user can update others posts
     *
     * @return void
     */
    function test_can_update_own_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $post = Post::factory()->make();
        Livewire::test(NewPost::class)
            ->set('post', $post)
            ->call('save');

        $post = Post::where('title', $post->title)->first();

        Livewire::test(EditPost::class, [
            'id' => $post->id
        ])
            ->set('post.title', 'test')
            ->set('post.body', $post->body)
            ->set('post.category', $post->category)
            ->set('post.summary', $post->summery)
            ->call('save')
            ->assertStatus(200);
    }
}

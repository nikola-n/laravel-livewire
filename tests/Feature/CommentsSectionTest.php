<?php

namespace Tests\Feature;

use App\Http\Livewire\CommentsSection;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class CommentsSectionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function main_page_contains_posts()
    {
        $post = Post::create([
            'title'   => 'My first Post',
            'content' => 'Content here',
        ]);

        $this->get('/')
            ->assertSee('My first Post');
    }

    /** @test */
    public function post_page_contains_comments_livewire_component()
    {
        $post = Post::create([
            'title'   => 'My first Post',
            'content' => 'Content here',
        ]);

        $this->get(route('post.show', $post))
            ->assertSeeLivewire('comments-section');
    }

    /** @test */
    public function valid_comment_can_be_posted()
    {
        $post = Post::create([
            'title'   => 'My first Post',
            'content' => 'Content here',
        ]);

        Livewire::test(CommentsSection::class)
            ->set('post', $post)
            ->set('comment', 'This is my comment')
            ->call('postComment')
            ->assertSee('Comment was posted')
            ->assertSee('This is my comment');
    }

    /** @test */
    public function comment_is_required()
    {
        $post = Post::create([
            'title'   => 'My first Post',
            'content' => 'Content here',
        ]);

        Livewire::test(CommentsSection::class)
            ->set('post', $post)
            ->call('postComment')
            ->assertHasErrors(['comment' => 'required'])
            ->assertSee('The comment field is required');
    }

    /** @test */
    public function comment_requires_min_characters()
    {
        $post = Post::create([
            'title'   => 'My first Post',
            'content' => 'Content here',
        ]);

        Livewire::test(CommentsSection::class)
            ->set('post', $post)
            ->set('comment', 'abs')
            ->call('postComment')
            ->assertHasErrors(['comment' => 'min'])
            ->assertSee('The comment must be at least 4 characters');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentsSection extends Component
{

    public Post $post;

    public $comment;

    public $successMessage;

    protected $rules = [
        'comment' => 'required|min:4',
    ];

    public function postComment()
    {
        //we dont need to call $request only $this
        $this->validate();
        Comment::create([
            'post_id'  => $this->post->id,
            'username' => 'Guest',
            'content'  => $this->comment,
        ]);

        $this->comment = '';

        $this->post->refresh();

        $this->successMessage = 'Comment was posted!';
    }

    //pass a parameter in the view :post="$post", and we dont need to call
    //mount function by default it will look for post.
    //public function mount(Post $post)
    //{
    //    $this->post = $post;
    //}

    public function render()
    {
        return view('livewire.comments-section');
    }
}

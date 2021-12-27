<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;


class NewComment extends Component
{
    public $comment;
    public $post_id;

    protected $rules = [
        'comment.body' => 'required|string|min:100'
    ];

    protected $messages = [
        'required' => 'This field is required',
        'min' => 'Value must be more than :min chars',
        'max' => 'Maximum value is 250 chars'
    ];

    public function render()
    {
        return view('livewire.new-comment')->layout("layouts/guest");
    }

    public function save()
    {
        $this->validate();
        $comment = Comment::create([
            'body' => $this->comment['body'],
            'user_id' => Auth()->user()->id,
            'post_id' => $this->post_id,
            'is_published' => true
        ]);

        $id = $comment->save();
        return redirect()
        ->with('message', 'Comment inserted correctly!')
        ->to(route('post-detail', ['id' => $this->post_id]));
        //session()->flash("message", "Comment inserted correctly!");
    }
}

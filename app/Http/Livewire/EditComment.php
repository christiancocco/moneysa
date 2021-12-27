<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;


class EditComment extends Component
{
    public $comment;
    public $comment_id;

    protected $rules = [
        'comment.body' => 'required|string|min:100'
    ];

    protected $messages = [
        'required' => 'This field is required',
        'min' => 'Value must be more than :min chars',
        'max' => 'Maximum value is 250 chars'
    ];

    public function mount()
    {
        if($this->comment_id)
            $this->comment = Comment::find($this->comment_id);
    }

    public function render()
    {
        return view('livewire.edit-comment')->layout("layouts/guest");
    }

    public function save()
    {
        $this->validate();
        $this->comment->save();
        return redirect()
        ->with('message', 'Comment updated correctly!')
        ->to(route('post-detail', ['id' => $this->comment->post_id]));
    }
}

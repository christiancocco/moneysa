<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

class DeleteCommentReason extends Component
{
    public $comment;

    protected $rules = [
        'comment.deleted_reason' => 'required|min:100:max:250',
    ];

    protected $messages = [
        'required' => 'This field is required',
        'min' => 'Value must be more than :min chars',
        'max' => 'Maximum value is 250 chars'
    ];

    public function mount($id)
    {
        $this->comment = Comment::find($id);
    }

    public function render()
    {
        return view('livewire.delete-comment-reason');
    }

    public function save()
    {
        $this->validate();
        $this->comment->deleted_user_id = Auth::user()->id;
        $this->comment->save();
        return redirect()
        ->with('message', 'Comment updated correctly!')
        ->to(route('post-detail', ['id' => $this->comment->post_id]));
    }


}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class DeletePostReason extends Component
{
    public $post;

    protected $rules = [
        'post.deleted_reason' => 'required|min:100:max:250',
    ];

    protected $messages = [
        'required' => 'This field is required',
        'min' => 'Value must be more than :min chars',
        'max' => 'Maximum value is 250 chars'
    ];

    public function mount($id)
    {
        $this->post = Post::find($id);
    }

    public function render()
    {
        return view('livewire.delete-post-reason');
    }

    public function save()
    {
        $this->validate();
        $this->post->deleted_user_id = Auth::user()->id;
        $this->post->save();
        return redirect()
        ->with('message', 'Post deleted correctly!')
        ->to(route('home'));
    }


}

<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EditPost extends Component
{
    public $post;
    public $isEdit = true;

    protected $rules = [
        'post.title' => 'required|string',
        'post.category' => 'required',
        'post.body' => 'required|string|min:500',
        'post.summary' => 'required|min:100:max:250'
    ];

    public function mount($id)
    {
        $this->post = Post::find($id);
    }

    public function render()
    {
        return view('livewire.new-post');
    }

    public function save()
    {
        if (Auth::user()->can('update', $this->post))
        {
            $this->validate();
            $this->post->save();
            return redirect()
            ->with('message', 'Post updated correctly!')
            ->to(route('post-detail', ['id' => $this->post->id]));
        }
        else
            abort(403, 'Permission Denied');
    }
}

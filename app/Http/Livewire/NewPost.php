<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;

class NewPost extends Component
{
    public $post;

    protected $rules = [
        'post.title' => 'required|string',
        'post.category' => 'required',
        'post.body' => 'required|string|min:500',
        'post.summary' => 'required|min:100:max:250'
    ];

    protected $messages = [
        'required' => 'This field is required',
        'min' => 'Value must be more than :min chars',
        'max' => 'Maximum value is 250 chars'
    ];

    public function render()
    {
        return view('livewire.new-post');
    }

    public function save()
    {
        if (Auth::check())
        {
            $this->validate();
            $post = Post::create([
                'title' => $this->post['title'],
                'summary' => $this->post['summary'],
                'category' => $this->post['category'],
                'body' => $this->post['body'],
                'published_date' => now(),
                'user_id' => Auth()->user()->id,
                'is_published' => true
            ]);

            $id = $post->save();
            return redirect()->to(route('home'));
        }
        else
            abort(403, 'Permission Denied');

    }
}

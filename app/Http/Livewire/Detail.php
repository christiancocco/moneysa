<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Detail extends Component
{
    public $post;
    public $comment_id;
    public $comment;
    protected $queryString = ['comment_id'];

    public function mount($id)
    {
        $this->post = Post::find($id);
        $this->post->readed++;
        $this->post->save();

        $this->comment = Comment::find($this->comment_id);

    }
    public function render()
    {

        if (Auth::check())
            return view('livewire.detail');
        else
            return view('livewire.detail')->layout("layouts/guest");
    }

    public function delete()
    {
        // load post
        $post = Post::find($this->post->id);

        if (Auth::user()->can('delete', $post))
        {
            if (Auth::user()->id === $post->user_id)
            {
                $post->deleted_user_id = Auth::user()->id;
                $post->save();
                return redirect()->to(route('home'));
            }
            else
            {
                return redirect()
                    ->to(route('add-post-deleted-reason', ['id' => $post]));
            }
        }
        else
            abort(403, 'Permission Denied');
    }
}

<?php
namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class Posts extends Component
{
    use WithPagination;

    public function render()
    {

        if (Gate::allows('access.dashboard'))
        {
            $posts = Post::paginate(10);
            return view('livewire.dashboard.posts',
                    ['posts' => $posts]
                );
        }
        else
            abort(403, 'Permission Denied');

    }

    public function delete(int $id)
    {
        //if (Gate::allows('delete.posts'))

        // load post
        $post = Post::find($id);

        if (Auth::user()->can('delete', $post))
        {
            $post = Post::find($id);
            $post->deleted_user_id = Auth::user()->id;
            $post->save();
            //$post->delete();
            session()->flash("message", "Post has been deleted");
        }
        else
            abort(403, 'Permission Denied');
    }

    public function publish(int $id)
    {
        $post = Post::find($id);
        $status = $post->is_published ? "unpublished": "published";
        $post->is_published = !$post->is_published;
        $post->published_date = now();
        $post->save();
        session()->flash("message", "Post $status successfully");
    }
}

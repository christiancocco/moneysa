<?php
namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShowPosts extends Component {
    public $posts;
    public $category;
    public $search;

    public function mount() {
        $this->posts = Post::orderBy('created_at', 'desc')->with('user')->get();
    }

    public function render() {
        if (Auth::check())
            return view('livewire.show-posts');
        else
            return view('livewire.show-posts')->layout("layouts/guest");
    }

    public function filter()
    {
        $category = $this->category;
        $search = $this->search;
        $this->posts = Post::with('user')
        ->when($this->category, function($q) use($category) {
            $q->where('category', $category);
        })
        ->when($this->search, function($q) use($search) {
            $q->where('title', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->get();
    }
}

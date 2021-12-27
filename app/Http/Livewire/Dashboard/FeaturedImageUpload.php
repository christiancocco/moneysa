<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class FeaturedImageUpload extends Component
{
    use WithFileUploads;
    public $photo;
    public $post;

    protected $rules = [
        'photo' => 'required|image|max:2048'
    ];

    public function mount($id)
    {
        $this->post = Post::find($id);
    }

    public function render()
    {
        return view('livewire.dashboard.featured-image-upload');
    }

    public function upload()
    {
        $this->validate();
        $extension = $this->photo->getClientOriginalExtension();
        $image = $this->photo->storeAs('posts/', Str::random(30) . "." . $extension);
        $this->post->featured_image = $image;
        $this->post->save();
        session()->flash("message", "Featured image successfully uploaded");
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class CommentItem extends Component
{
    public $comment;
    public $created;

    public function mount()
    {
        $this->created = $this->getCreatedTime($this->comment->created_at);
    }
    public function render()
    {
        return view('livewire.comment-item');
    }

    public function delete(int $id)
    {
        // load Comment
        $comment = Comment::with('user')->find($id);

        if (Auth::user()->can('delete', $comment))
        {
            if (Auth::user()->id === $comment->user_id)
            {
                $comment = Comment::find($id);
                $comment->deleted_user_id = Auth::user()->id;
                $comment->save();
                return redirect()
                    ->with('message', 'Comment deleted correctly!')
                    ->to(route('post-detail', ['id' => $comment->post_id]));
            }
            else
            {
                return redirect()
                    ->to(route('add-comment-deleted-reason', ['id' => $comment]));
            }
        }
        else
            abort(403, 'Permission Denied');
    }

    private function getCreatedTime($createdDate)
    {
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $createdDate);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', now());

        $diff_in_days = $to->diffInDays($from);
        $diff_in_hours = $to->diffInHours($from);
        $diff_in_minutes = $to->diffInMinutes($from);
        $retValue = "";
        if ($diff_in_minutes > 59)
            if ($diff_in_hours > 23)
                $retValue = $diff_in_days . " days ago";
            else
                $retValue = $diff_in_hours . " hours ago";
        else
            $retValue = $diff_in_minutes . " minutes ago";
        return $retValue;
    }
}

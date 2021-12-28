<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostItem extends Component {
    public $post;
    public $created;

    public function mount()
    {
        $this->created = $this->getCreatedTime($this->post->created_at);
    }

    public function render() {
        return view('livewire.post-item');
    }

    private function getCreatedTime($createdDate)
    {
        $to = \Carbon\Carbon::parse($createdDate);
        $now = \Carbon\Carbon::now();
        $diff_in_days = $to->diffInDays($now);
        $diff_in_hours = $to->diffInHours($now);
        $diff_in_minutes = $to->diffInMinutes($now);
        $diff_in_seconds = $to->diffInSeconds($now);
        $retValue = "";
        if ($diff_in_seconds > 59)
            if ($diff_in_minutes > 59)
                if ($diff_in_hours > 23)
                    $retValue = $diff_in_days . " days ago";
                else
                    $retValue = $diff_in_hours . " hours ago";
            else
            {
                $retValue = $diff_in_minutes . " minutes ago";
            }
        else
            $retValue = $diff_in_seconds . " seconds ago";

        return $retValue;
    }
}

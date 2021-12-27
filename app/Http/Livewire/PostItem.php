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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * Columns that are mass assignable
     */
    protected $fillable = [
        'body', 'user_id', 'post_id', 'is_published'
    ];

    /**
     * Returns the user for this comment
     */
    public function user() {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Returns the post for this comment
     */
    public function post() {
        return $this->belongsTo(Post::class)->withDefault();
    }
}

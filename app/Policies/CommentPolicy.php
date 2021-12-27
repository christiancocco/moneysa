<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     /**
   * Determine whether the user can delete the post.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Comment  $comment
   * @return mixed
   */
  public function delete(User $user, Comment $comment)
  {
    return $user->hasRole('Administrator') || $user->id === $comment->user_id;
  }

  /**
   * Determine whether the user can update the post.
   *
   * @param  \App\Models\User  $user
   * @param  \App\Models\Comment  $comment
   * @return mixed
   */
  public function update(User $user, Comment $comment)
  {
    return $user->id === $comment->user_id;
  }

  /**
   * Determine whether the user can create the comment.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return $user->hasRole('administrator') || $user->hasRole('user');
  }
}

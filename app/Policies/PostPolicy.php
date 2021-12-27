<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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
   * @param  \App\User  $user
   * @param  \App\Post  $post
   * @return mixed
   */
  public function delete(User $user, Post $post)
  {
    return $user->hasRole('Administrator') || $user->id === $post->user_id;
  }

  /**
   * Determine whether the user can update the post.
   *
   * @param  \App\User  $user
   * @param  \App\Post  $post
   * @return mixed
   */
  public function update(User $user, Post $post)
  {
    return $user->id === $post->user_id;
  }

  /**
   * Determine whether the user can create the post.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(User $user)
  {
    return $user->hasRole('Administrator') || $user->hasRole('User');
  }



}

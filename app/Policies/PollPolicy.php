<?php

namespace App\Policies;

use App\Models\Poll;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PollPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
       
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poll  $poll
     * @return mixed
     */
    public function view(User $user, Poll $poll)
    {
        //
        return $user->organization_id == $poll->organization_id 
        ? Response::allow() : Response::deny('You cannot view this poll.');

    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
       return $user->is_admin === '1' ? Response::allow() : Response::deny('You cannot create poll.');

    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poll  $poll
     * @return mixed
     */
    public function update(User $user, Poll $poll)
    {
        //
       return $user->organization_id == $poll->organization_id && $user->is_admin === '1' 
       ? Response::allow() : Response::deny('You cannot edit poll.');

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poll  $poll
     * @return mixed
     */
    public function delete(User $user, Poll $poll)
    {
        //
        return $user->organization_id == $poll->organization_id && $user->is_admin === '1' 
       ? Response::allow() : Response::deny('You cannot delete poll.');

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poll  $poll
     * @return mixed
     */
    public function restore(User $user, Poll $poll)
    {
        //
        return $user->organization_id == $poll->organization_id && $user->is_admin === '1' 
        ? Response::allow() : Response::deny('You cannot restore poll.');

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Poll  $poll
     * @return mixed
     */
    public function forceDelete(User $user, Poll $poll)
    {
        //
        //return $user->is_admin === '1' ? Response::allow() : Response::deny('You cannot force delete poll.');
    }
}

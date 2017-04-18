<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;

class UserPolicy
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
     * Checks to see if the logged in user is able to update the requested user's profile.
     *  Returns true if the logged in user is updating their own profile, or if
     *  the logged in user has 'Director' permissions. Otherwise, false.
     *
     * @return boolean
     */
    public function update(User $user, User $user_to_edit) {
        return $user->email === $user_to_edit->email || $user->role->name === 'Director';
    }

    /**
     * Checks to see if the logged in user is able to update the requested user's password.
     *  Returns true if the logged in user is updating their own password.
     *  Otherwise, false.
     *
     * @return boolean
     */
    public function update_pass(User $user, User $user_to_edit) {
        return $user->email === $user_to_edit->email;
    }

    /**
     * Checks to see if the logged in user is able to update the requested user's role_id.
     *  Returns true if the logged in user has 'Director' permissions.
     *  Otherwise, false.
     *
     * @return boolean
     */
    public function update_role_id(User $user, User $user_to_edit) {
        return $user->role->name === 'Director';
    }
}

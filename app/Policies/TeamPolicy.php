<?php

namespace App\Policies;

use App\Team;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function update(User $user, Team $team)
    {
        return $user->id === $team->user_id;
    }
    public function delete(User $user, Team $team)
    {
        return $user->id === $team->user_id;
    }
}

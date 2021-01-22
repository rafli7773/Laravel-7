<?php

namespace App\Policies;

use App\Player;
use App\Team;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PlayerPolicy
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

    public function update(User $user, Player $player)
    {
        return $user->id === $player->user_id;
    }
    public function delete(User $user, Player $player)
    {
        return $user->id === $player->user_id;
    }
}

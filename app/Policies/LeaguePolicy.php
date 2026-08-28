<?php

namespace App\Policies;

use App\Models\League;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LeaguePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, League $league): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->is_admin
            ? Response::allow()
            : Response::deny('Only an admin can perform this action');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, League $league): Response
    {
        if ($league->name === 'House League') {
            return Response::deny('House League cannot be modified');
        }

        if ($user->is_admin) {
            return Response::allow();
        } else {
            return Response::deny('Only an admin can perform this action');
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, League $league): Response
    {
        if ($league->name === 'House League') {
            return Response::deny('House League cannot be modified');
        }

        if ($user->is_admin) {
            return Response::allow();
        } else {
            return Response::deny('Only an admin can perform this action');
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, League $league): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, League $league): bool
    {
        return false;
    }
}

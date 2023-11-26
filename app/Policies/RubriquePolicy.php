<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Rubrique;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RubriquePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        $usr = User::find($user->id);
        $role=Role::find($usr->role_id);
        return $role->role==='Admin' || $role->role==='Redac';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {
        //
        $usr = User::find($user->id);
        $role=Role::find($usr->role_id);
        return $role->role==='Admin' || $role->role==='Redac';
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        $usr = User::find($user->id);
        $role=Role::find($usr->role_id);
        return $role->role==='Admin' || $role->role==='Redac';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        //
        $usr = User::find($user->id);
        $role=Role::find($usr->role_id);
        return $role->role==='Admin' || $role->role==='Redac';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user): bool
    {
        //
        $usr = User::find($user->id);
        $role=Role::find($usr->role_id);
        return $role->role==='Admin' || $role->role==='Redac';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Rubrique $rubrique): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Rubrique $rubrique): bool
    {
        //
    }
}

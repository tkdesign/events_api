<?php

namespace App\Policies;

use App\Models\Schedules_has_stages;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SchedulesHasStagesPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Schedules_has_stages $schedulesHasStages): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Schedules_has_stages $schedulesHasStages): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Schedules_has_stages $schedulesHasStages): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Schedules_has_stages $schedulesHasStages): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Schedules_has_stages $schedulesHasStages): bool
    {
        //
    }
}

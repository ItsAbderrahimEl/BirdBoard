<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task): bool
    {
        $project = $task->project;
        return $user->is($project->user) || $project->members->contains($user);
    }

    public function delete(User $user, Task $task): bool
    {
        $project = $task->project;
        return $user->is($project->user) || $project->members->contains($user);
    }
}

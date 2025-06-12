<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return $user->is($project->user) || $project->members->contains($user);
    }

    public function store(User $user, Project $project): bool
    {
        return $user->is($project->user);
    }

    public function update(User $user, Project $project): bool
    {
        return $user->is($project->user) || $project->members->contains($user);
    }

    public function delete(User $user, Project $project): bool
    {
        return $user->is($project->user);
    }

    public function inviteTo(User $user, Project $project): bool
    {
        return $user->is($project->user);
    }

    public function deleteMember(User $user, Project $project): bool
    {
        return $user->is($project->user);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProjectInvitationController extends Controller
{
    public function store(Project $project, ProjectInvitationRequest $request)
    {
        $user = User::whereEmail(request('email'))->firstOrFail();

        $project->invite($user);
    }

    public function destroy(Project $project, User $member)
    {
        $this->authorize('deleteMember', $project);

        DB::table('project_members')
            ->where('project_id', $project->id)
            ->where('user_id', $member->id)
            ->delete();
    }
}

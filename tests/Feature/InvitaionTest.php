<?php

use App\Models\Project;
use App\Models\Task;

beforeEach(function () {
    $this->owner = user();
    $this->invitedUser = user();
    $this->project = (Project::factory()
        ->recycle($this->owner)
        ->create(['title' => 'Test']))
        ->invite($this->invitedUser);
});

it('Can invite a user to a project', function () {
    $this->assertDatabaseHas('project_members', [
        'user_id' => $this->invitedUser->id,
        'project_id' => $this->project->id,
    ]);
});

it('Allows invited users to update a project', function () {
    login($this->invitedUser)->patch($this->project->path(), [
        'title' => 'Changed'
    ]);

    $this->assertDatabaseHas(Project::class, [
        'title' => 'Changed'
    ]);
});

it('Allows invited users to update a task', function () {
    $this->withoutExceptionHandling();
    $task = $this->project->addTask();

    login($this->invitedUser)->patch($task->path(), [
        'body' => 'Changed'
    ])->assertOk();

    $this->assertDatabaseHas(Task::class, [
        'body' => 'Changed'
    ]);
});

it('Shows all projects to invited users on the dashboard', function () {
    login($this->invitedUser)->get(route('projects.index'))
        ->assertSee($this->project->title);
});

it('Allows a project owner to invite other users', function () {
    //the other users are all ready invited
    $owner = user();
    $invited = user();

    $project = Project::factory()->recycle($owner)->create();

    login($owner)->post(route('projects.invite', $project), [
        'email' => $invited->email,
    ])->assertOk();

    $this->assertDatabaseHas('project_members', [
        'user_id' => $invited->id,
        'project_id' => $project->id,
    ]);
});

it('Prevents a project member from inviting other users', function () {
    login($this->invitedUser)->post(route('projects.invite', $this->project))
        ->assertForbidden();
});

it('Requires the invited user to have a valid BirdBoard account', function () {
    login($this->owner)->post(route('projects.invite', $this->project), [
        'email' => 'nonExistingEmail@gmail.com'
    ])->assertSessionHasErrors(['email' => 'The user with this email does not exist.']);
});

it('Cannot delete the projects of the owner', function () {
    login($this->invitedUser)->delete($this->project->path())
        ->assertForbidden();
});

test('A member cannot delete another member', function () {
    login($this->invitedUser)
        ->delete(route('projects.members.destroy', [
            'project' => $this->project->id,
            'member' => $this->invitedUser->id
        ]))->assertStatus(403);
});

test('An owner can delete a member', function () {
    login($this->owner)
        ->delete(route('projects.members.destroy', [
            'project' => $this->project->id,
            'member' => $this->invitedUser->id
        ]))->assertOk();

    $this->assertDatabaseMissing('project_members', [
        'user_id' => $this->invitedUser->id,
        'project_id' => $this->project->id,
    ]);
});



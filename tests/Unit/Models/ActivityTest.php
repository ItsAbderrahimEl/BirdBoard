<?php

use App\Models\Activity;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

it('Belongs to a project', function () {
    $activity = Activity::factory()
        ->create();

    expect($activity->project)
        ->toBeInstanceOf(Project::class);
});

it('Remember the modified task', function () {
    $task = tap(Project::factory()->create(),
        function ($project) {})
        ->addTask();

    $activity = Activity::factory()
        ->for($task, 'subject')
        ->create();

    expect($activity->subject)->toBeInstanceOf(Task::class);
});

it('Belongs to the owner of the project', function () {
    $user = user();
    Project::factory()->recycle($user)->create();
    $activity = Activity::first();

    $this->assertInstanceOf(User::class, $activity->user);
});
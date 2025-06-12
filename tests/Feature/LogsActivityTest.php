<?php

use App\Models\Activity;
use App\Models\Project;

beforeEach(function () {
    $this->project = Project::factory()->create();
    $this->task = $this->project->addTask();
});

it('creating a project', function () {
    $activity = Activity::where('body', 'project_created')->first();

    tap($activity, function ($activity) {
        $this->assertNotNull($activity);

        $this->assertNull($activity->changes);
    });
});

it('updating a project', function () {
    $originalTitle = $this->project->title;

    $this->project->update(['title' => 'Updated title']);

    $activity = Activity::where('body', 'project_updated')->first();

    tap($activity, function ($activity) use ($originalTitle) {
        $this->assertNotNull($activity);

        $expected = [
            'before' => ['title' => $originalTitle],
            'after' => ['title' => 'Updated title']
        ];

        $this->assertEquals($expected, $activity->changes);
    });
});

it('logs activity when a task is created', function () {
    $this->assertDatabaseHas(Activity::class, [
        'body' => 'task_created',
    ]);
});

it('updating a task', function () {
    $this->task->update(['body' => 'Updated task']);

    $this->assertDatabaseHas(Activity::class, [
        'body' => 'task_updated'
    ]);
});

it('deleting a task', function () {
    $this->withoutExceptionHandling();
    $this->task->delete();

    $this->assertDatabaseHas(Activity::class, [
        'body' => 'task_deleted'
    ]);
});

it('complete and incomplete a task', function () {
    $this->task->update(['complete' => true]);

    $this->assertDatabaseHas(Activity::class, [
        'body' => 'task_completed'
    ]);

    $this->task->update(['complete' => false]);

    $this->assertDatabaseHas(Activity::class, [
        'body' => 'task_uncompleted'
    ]);
});

it('Stocks the previous task if deleted', function () {
    $originalBody = $this->task->body;

    $this->task->delete();

    $activity = Activity::where('body', 'task_deleted')->first();

    $this->assertEquals($originalBody, $activity->changes['before']['body']);
});

it('Logs the project if it is deleted', function () {
    $this->withoutExceptionHandling();
    $this->project->delete();

    $this->assertDatabaseHas(Activity::class, [
        'body' => 'project_deleting'
    ]);
});
<?php

use App\Models\Project;
use App\Models\Task;

it('Manage unauthorized users', function () {
    login();
    $this->project = Project::factory()->create();
    $this->task = $this->project->addtask();

    $this->post($this->project->path().'/tasks')->assertStatus(403);
    $this->patch($this->task->path())->assertStatus(403);
    $this->delete($this->task->path())->assertStatus(403);
});

describe('functionality', function () {
    beforeEach(function () {
        login();
        $this->project = Project::factory()->recycle(Auth::user())->create();
        $this->task = $this->project->addTask();
    });

    it('Validates the create task form', function () {
        $this->post($this->project->path().'/tasks')
            ->assertSessionHasErrors(['body']);
    });

    it('Create a task', function () {
        $this->post($this->project->path().'/tasks', [
            'body' => 'Test task',
        ])->assertRedirect($this->project->path());

        $this->assertDatabaseHas(Task::class, [
            'project_id' => $this->project->id,
            'body' => 'Test task'
        ]);
    });

    it('Updates a task', function () {
        $this->patch($this->task->path(), [
            'body' => 'Updated task',
        ]);

        $this->assertDatabaseHas(Task::class, [
            'id' => $this->task->id,
            'project_id' => $this->project->id,
            'body' => 'Updated task'
        ]);
    });

    it('Completes a task', function () {
        expect($this->task->complete)->toBeFalse();

        $this->patch($this->task->path(), [
            'complete' => true,
        ]);

        expect($this->task->refresh()->complete)->toBeTrue();
    });

    it('Deletes a task', function () {
        $this->delete($this->task->path());

        $this->assertDatabaseMissing(Task::class, ['body' => 'Test task']);
    });
});
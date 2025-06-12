<?php

use App\Models\Project;
use App\Models\Task;

uses()->group('models');

beforeEach(function () {
    $this->task = Task::factory()->create();
});

it('Ensures that a task belongs to a project', function () {
    expect($this->task->project)
        ->toBeInstanceOf(Project::class);
});

it('Ensures that a task has a body', function () {
    expect($this->task->body)->not()->toBeNull();
});

it('Has a path method to show the task', function () {
    expect($this->task->path())
        ->toEqual("/tasks/{$this->task->id}");
});

it('Ensures that a task can be completed', function () {
    expect($this->task->complete)
        ->not()->toBeNull();
});


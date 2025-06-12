<?php

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

uses()->group("models");

beforeEach(function () {
    $this->project = Project::factory()->create();
});

it('Ensure the project belongs to a user', function () {
    expect($this->project->user)->toBeInstanceOf(User::class);
});

it('Ensure the project has a title and description and notes', function () {
    $this->assertNotNull($this->project->title);
    $this->assertNotNull($this->project->description);
    $this->assertNotNull($this->project->notes);
});

it('Has a path method that return the path to the project', function () {
    expect($this->project->path())
        ->toBe("/projects/{$this->project->id}");
});

it('Can have multiple tasks', function () {
    Task::factory(5)->recycle($this->project)->create();

    $this->project->tasks->each(function ($task) {
        expect($task)->toBeInstanceOf(Task::class);
    });

    $this->assertCount(5, $this->project->tasks);
});

it('Has activity', function () {
    $this->assertNotNull($this->project->activity);
});

it('Can invite a user', function () {
    $this->project->invite($user = user());

    $this->assertTrue($this->project->members->contains($user));
});
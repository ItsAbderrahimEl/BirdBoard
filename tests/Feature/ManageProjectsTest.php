<?php

use App\Models\Project;
use App\Models\Task;

it('Manage guest users', function () {
    $project = Project::factory()->create();

    $this->get(route('projects.index'))->assertRedirectToRoute('login.get');
    $this->get($project->path())->assertRedirectToRoute('login.get');
    $this->delete($project->path())->assertRedirectToRoute('login.get');
});

it('Manage unauthorized users', function () {
    login();
    $project = Project::factory()->create();

    $this->get($project->path())->assertStatus(403);
    $this->patch($project->path())->assertStatus(403);
    $this->delete($project->path())->assertStatus(403);
});

describe('functionality', function () {
    beforeEach(function () {
        login();
        $this->project = Project::factory()
            ->recycle(Auth::user())
            ->create();
    });

    it('Display projects owned by a user', function () {
        $projects = Project::factory(5)
            ->recycle(Auth::user())
            ->create([
                'title' => 'Test project'
            ]);

        $this->get(route('projects.index'))
            ->assertSeeText($projects->pluck('title')->toArray());
    });

    it('Validate the create project form', function () {
        $this->post(route('projects.store'))
            ->assertSessionHasErrors(['title', 'description']);
    });

    it('Store a new project', function () {
        $project = Project::factory()->recycle(Auth::user())
            ->raw([
                'notes' => NULL,
            ]);

        $this->post(route('projects.store'), $project)->assertOk();
        $this->assertDatabaseHas(Project::class, Arr::except($project, 'tasks'));
    });

    it('Store a new project with tasks', function () {
        $project = Project::factory()->recycle(Auth::user())
            ->raw([
                'notes' => NULL,
                'tasks' => [
                    0 => 'Test task',
                ]
            ]);

        $this->post(route('projects.store'), $project)->assertOk();
        $this->assertDatabaseHas(Project::class, Arr::except($project, 'tasks'));
        $this->assertDatabaseHas(Task::class, ['body' => 'Test task']);
    });

    it('Show a specific project with there tasks', function () {
        $tasks = Task::factory(7)
            ->recycle($this->project)
            ->create();

        $this->get($this->project->path())
            ->assertSee($this->project->title)
            ->assertSee($tasks->pluck('body')->toArray());
    });

    it('Validates the update form', function () {
        $this->patch($this->project->path(), [
            'title' => 'up',
            'description' => 'upd',
            'notes' => 'upd',
        ])->assertSessionHasErrors(['notes', 'description', 'title']);
    });

    it('Updates the project notes', function () {
        $this->patch($this->project->path(), [
            'notes' => 'updated notes',
        ]);

        $this->assertDatabaseHas(Project::class, [
            'id' => $this->project->id,
            'notes' => 'updated notes',
            'description' => $this->project->description,
        ]);
    });

    it('Updates the project title and description', function () {
        $this->withoutExceptionHandling();
        $title = 'updated title';
        $description = 'updated description';

        $this->patch($this->project->path(), compact('title', 'description'));

        $this->assertDatabaseHas(Project::class, compact('title', 'description'));
    });

    it('Allow a user to delete their project', function () {
        $this->withoutExceptionHandling();
        $this->delete($this->project->path())
            ->assertRedirectToRoute('projects.index');

        $this->assertDatabaseMissing(
            Project::class,
            $this->project->toArray()
        );
    });
});
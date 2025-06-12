<?php

use App\Models\Project;

uses()->group("models");

it('Ensure a user has an email a password a name and an image', function () {
    $this->withoutExceptionHandling();
    $this->assertNotNull(user()->name);
    $this->assertNotNull(user()->email);
    $this->assertNotNull(user()->password);
    $this->assertNotNull(user()->avatar);
});

it('Ensure a user can have multiple projects', function () {
    Project::factory(5)->recycle($user = user())->create();

    $user->projects->each(
        function ($project) {
            expect($project)->toBeInstanceOf(Project::class);
        }
    );

    $this->assertCount(5, $user->projects);
});

it('Can have an activities', function () {
    $user = user();
    login($user);
    Project::factory()->recycle($user)->create();

    $this->assertEquals($user->id, $user->activity->first()->user_id);
});
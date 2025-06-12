<?php

use App\Models\User;

uses()->group('register');

it('Show the register page', function () {
    $this->get(route('register.get'))
        ->assertSee(['Email', 'Name', 'Password', 'Confirm Password'])
        ->assertStatus(200)
        ->assertViewIs('Auth.register');
});

it('Validate register form', function () {
    $this->post(route('register.post'), [
        'email' => 'test@test',
        'password' => 'password',
        'name' => 'test452',
        'password_confirmation' => '',
    ])->assertSessionHasErrors(['email', 'name', 'password']);
});

it('Create a new account', function () {
    $this->assertGuest();

    $this->post(route('register.post'), [
        'email' => 'test@test.com',
        'name' => 'test testTest',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertRedirectToRoute('projects.index');

    $this->assertDatabaseHas(User::class, [
        'email' => 'test@test.com',
        'name' => 'test testTest'
    ]);

    $this->assertAuthenticated();
});

it('Redirect authenticated users to the projects page', function () {
    login()->get(route('register.get'))->assertRedirectToRoute('projects.index');
});
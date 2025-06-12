<?php

uses()->group('login');

it('Show the login page', function () {
    $this->get(route('login.get'))
        ->assertOk()
        ->assertSee(['Email', 'Password', 'Remember'])
        ->assertViewIs('Auth.login');
});

it('Validate login form', function () {
    $this->post(route('login.post'), [
        'email' => 'test@',
        'password' => 'pass',
    ])->assertSessionHasErrors(['email', 'password']);
});

it('Return failed authentication message', function () {
    $this->post(route('login.post'), [
        'email' => 'failed_email@email.com',
        'password' => 'password',
    ])
        ->assertSessionHasErrors(['email' => 'The provided credentials do not match our records.'])
        ->isRedirect(route('login.get'));

    $this->assertGuest();
});

it('Log a user', function () {
    $this->post(route('login.post'), [
        'email' => user()->email,
        'password' => 'password',
    ])->isRedirect(route('projects.index'));

    $this->assertAuthenticated();
});

it('Redirect authenticated users to the projects page', function () {
    login()->get(route('login.get'))->assertRedirectToRoute('projects.index');
});

it('Logout', function () {
    login();
    $this->assertAuthenticated();
    $this->post(route('logout'))->assertRedirectToRoute('login.get');
    $this->assertGuest();
});

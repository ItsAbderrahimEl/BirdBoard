<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectInvitationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\auth;
use App\Http\Middleware\guest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login.get');
});

Route::middleware(guest::class)->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'create')->name('login.get');
        Route::post('/login', 'store')->name('login.post');
    });
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'create')->name('register.get');
        Route::post('/register', 'store')->name('register.post');
    });
});

Route::middleware(auth::class)->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::controller(ProjectController::class)
        ->prefix('projects')
        ->group(function () {
            Route::get('/', 'index')->name('projects.index');
            Route::post('/', 'store')->name('projects.store');
            Route::get('/{project}', 'show')->name('projects.show');
            Route::patch('/{project}', 'update')->name('projects.update');
            Route::delete('/{project}', 'destroy')->name('projects.destroy');
        });

    Route::controller(ProjectInvitationController::class)->group(function () {
        Route::post('/projects/{project}/invitations', 'store')->name('projects.invite');
        Route::delete('/projects/{project}/members/{member}', 'destroy')->name('projects.members.destroy');
    });

    Route::controller(TaskController::class)->group(function () {
        Route::post('/projects/{project}/tasks', 'store')->name('tasks.store');
        Route::patch('/tasks/{task}', 'update')->name('tasks.update');
        Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
    });
});

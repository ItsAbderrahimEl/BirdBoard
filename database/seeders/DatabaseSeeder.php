<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        Project::factory(10)->recycle($users)->create();

        $user = User::factory()->create([
            'name' => 'Abderrahim El Ouariachi',
            'email' => 'test@gmail.com',
        ]);

        $projects = Project::factory(12)->recycle($user)->create();
        Task::factory(50)->recycle($projects)->create();
    }
}

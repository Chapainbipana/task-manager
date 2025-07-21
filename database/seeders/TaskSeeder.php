<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Design Dashboard UI',
            'description' => 'Create a responsive layout for the admin dashboard.',
            'image' => 'uploads/tasks/design.png',
            'priority' => 'high',
            'status_id' => 1, // Assume 1 = To Do
            'created_by' => 1, // Admin
            'assigned_to' => 2, // Regular user
        ]);
        Task::create([
            'title' => 'Implement Auth System',
            'description' => 'Use Laravel Breeze or Jetstream to handle user authentication.',
            'image' => null,
            'priority' => 'medium',
            'status_id' => 2, // In Progress
            'created_by' => 2,
            'assigned_to' => 2,
        ]);
        Task::create([
            'title' => 'Write Seeder Data',
            'description' => 'Seed roles, users, and tasks using Laravel seeders.',
            'image' => null,
            'priority' => 'low',
            'status_id' => 3, // Done
            'created_by' => 1,
            'assigned_to' => null,
        ]);
    }
}

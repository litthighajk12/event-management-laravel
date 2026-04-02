<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User with password
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create regular user with specific credentials
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create 5 additional regular users
        User::factory()
            ->count(5)
            ->create();

        // Seed events
        $this->call([
            EventSeeder::class,
        ]);

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('👤 Admin Login: admin@example.com / password');
        $this->command->info('👤 User Login: user@example.com / password');
        $this->command->info('📅 Events: 25 sample events created');
    }
}

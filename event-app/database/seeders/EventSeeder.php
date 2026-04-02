<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This creates 25 realistic events for testing
     */
    public function run(): void
    {
        // Create 25 events using the factory
        Event::factory()
            ->count(25)
            ->create();

        // Display message
        $this->command->info('✅ Created 25 events successfully!');
        $this->command->info('📅 Events generated with future dates');
        $this->command->info('💰 Prices range from free to $250');
        $this->command->info('👥 Capacities range from 20 to 500 attendees');
    }
}

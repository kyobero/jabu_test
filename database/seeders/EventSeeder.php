<?php

namespace Database\Seeders;

use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 events
        Event::factory()
            ->count(5)
            ->create()
            ->each(function ($event) {
                // Each event gets 10 seats
                Seat::factory()
                    ->count(10)
                    ->create([
                        'event_id' => $event->id,
                        'is_reserved' => false,
                    ]);
            });
    }
}

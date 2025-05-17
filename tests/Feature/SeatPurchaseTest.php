<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use App\Models\Seat;
use Tests\TestCase;
//use Illuminate\Support\Facades\Queue;
//use Illuminate\Support\Facades\Bus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jobs\HandlePayment;

class SeatPurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_one_user_can_purchase_the_seat()
    {
        // Create 150 users
        $users = User::factory()->count(15)->create();

        // Create 1 event and 1 seat
        $event = Event::create(['name' => 'Concert']);
        $seat = Seat::create([
            'event_id' => $event->id,
            'is_reserved' => false,
        ]);

        // Dispatch 150 jobs to reserve the same seat
        foreach ($users as $user) {
            HandlePayment::dispatch($user->id, $seat->id);
        }

        // Run the queue synchronously
        $this->artisan('queue:work --stop-when-empty');

        $seat->refresh();

//        $this->assertTrue($seat->is_reserved);
        $this->assertNotNull($seat->user_id);

        // Make sure only one seat is reserved
//        $k = Seat::where('id', $seat->id)->where('is_reserved', true)->get();
//        dd($k);
//        exit;
        $this->assertEquals(1, Seat::where('id', $seat->id)->where('is_reserved', true)->count());
    }
}

<?php

namespace App\Jobs;

use App\Models\Seat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class HandlePayment implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $order_id = Seat::insertGetId([
            'user_id' => 1,
            'event_id' => 1,
            'seat_map' => '10x10',
            'available_seats' => 15,
            'sold_seats' => 5,
       ]);
       dd('All ready'.$order_id);
    }
}

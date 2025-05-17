<?php

namespace App\Jobs;

use App\Models\Seat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class HandlePayment implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    protected $seatId;

    /**
     * Create a new job instance.
     */
    public function __construct($userId,$seatId)
    {
        $this->userId = $userId;
        $this->seatId = $seatId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function () {
            $seat = Seat::where('id', $this->seatId)->lockForUpdate()->first();

            if (!$seat->is_reserved) {
                $seat->is_reserved = true;
                $seat->user_id = $this->userId;
                $seat->save();
            }
        }, 3); //3 attempts
    }
}

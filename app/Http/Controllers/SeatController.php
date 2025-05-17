<?php

namespace App\Http\Controllers;

use App\Jobs\HandlePayment;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function reserveSeat(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'seat_id' => 'required|exists:seats,id',
        ]);

        HandlePayment::dispatch($request->user_id, $request->seat_id);

        return response()->json(['message' => 'Seat purchase successful.']);
    }
}

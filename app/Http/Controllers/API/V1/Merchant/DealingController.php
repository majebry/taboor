<?php

namespace App\Http\Controllers\API\V1\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Booking;
use Illuminate\Support\Facades\Auth;

class DealingController extends Controller
{
    public function store(Request $request, $booking_id)
    {
        $last_dealing = Auth::guard('merchant')->user()->dealings()->latest()->first();

        return Booking::findOrFail($booking_id)->dealing()->create([
            'started_at'    =>  $last_dealing ? $last_dealing->finished_at : null, //change to previous deal finish time or the start of the shift
            'finished_at'    =>  now(),
        ]);
    }
}

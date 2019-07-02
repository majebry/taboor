<?php

namespace App\Http\Controllers\API\V1\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Merchant;
use Illuminate\Support\Facades\Auth;
use App\Booking;
use Carbon\Carbon;
use App\Events\ClientBooked;

class BookingController extends Controller
{
    public function store(Request $request, $merchant_id)
    {
        // x check that client has no non-dealed number for that day requested merchant

        $merchant = Merchant::findOrFail($merchant_id);

        if (now()->isBefore(Carbon::createFromFormat('H:i:s', $merchant->closes_at))) {
            $date = today();
        } else {
            $date = today()->addDay(1);
        }

        $last_merchant_booking = $merchant->bookings()->latest()->first();

        $number = $last_merchant_booking ? ($last_merchant_booking->number + 1) : 1;

        if (! $merchant->bookings()->whereDate('date', today()->addDay(1))->count()) {
            $number = 1;
        }

        $new_booking = new Booking([
            'date' =>   $date,
            'number' => $number
        ]);

        $new_booking->merchant()->associate($merchant);

        $booking = Auth::guard('client')->user()->bookings()->save($new_booking);

        // if ($booking) {
            event(new ClientBooked());
            broadcast(new ClientBooked());
        // }

        return $booking;
    }

    public function destroy($booking_id)
    {
        Auth::guard('client')->user()
            ->bookings()
            ->findOrFail($booking_id)
            ->delete();

        response()->json(null, 204);
    }
}

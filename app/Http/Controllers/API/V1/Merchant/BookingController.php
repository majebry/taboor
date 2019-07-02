<?php

namespace App\Http\Controllers\API\V1\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        return Auth::guard('merchant')->user()
            ->bookings()->with('client')
            ->where('date', today())
            ->doesntHave('dealing')->get(); // except dealed with or cancelled or in the past
    }

    public function destroy($booking_id)
    {
        Auth::guard('merchant')->user()
            ->bookings()
            ->findOrFail($booking_id)
            ->delete();

        response()->json(null, 204);
    }
}

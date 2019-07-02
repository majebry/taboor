<?php

namespace App\Http\Controllers\API\V1\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Merchant;
use Illuminate\Support\Facades\Auth;
use App\Dealing;

class MerchantController extends Controller
{
    public function index()
    {
        return Merchant::with(['bookings' => function($q) {
            $q->where('client_id', Auth::guard('client')->id())
                ->whereDoesntHave('dealing');
        }])->get()
        ->each(function($merchant) {
            return $merchant['in_line'] =  $merchant->bookings()->whereDate('date', today())->whereDoesntHave('dealing')->count();
        });
    }
}

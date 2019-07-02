<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatsController extends Controller
{
    public function index(Request $request)
    {
        // $dealings = Auth::guard('merchant')->user()->dealings();

        // if ($request->day) {
        //     $dealings->whereDate('created_at', $request->year . '-' . $request->month . '-' . $request->day);
        // }
    }
}

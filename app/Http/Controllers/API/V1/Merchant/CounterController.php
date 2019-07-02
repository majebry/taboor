<?php

namespace App\Http\Controllers\API\V1\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterController extends Controller
{
    public function create()
    {
        return view('merchant.counters.create');
    }
}

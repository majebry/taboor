<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/merchant/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('merchant.auth:merchant');
    }

    /**
     * Show the Merchant dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return redirect()->route('merchant.bookings.index');
    }

}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/client/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('client.auth:client');
    }

    /**
     * Show the Client dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return redirect()->route('client.merchants.index');
    }

}

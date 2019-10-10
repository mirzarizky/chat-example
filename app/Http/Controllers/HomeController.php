<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chat;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $conversations = Chat::conversations()
          ->setUser(Auth::user())
          ->get();

        return view('home', compact('conversations'));
    }
}

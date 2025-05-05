<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use DB;

class Home2Controller extends Controller
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

    public function home_2()
    {
        $allBookings = DB::table('bookings')->get();
        $proyek = DB::table('proyek')->count();
        return view('dashboard_2.home_2',compact('allBookings', 'proyek'));
    }
}

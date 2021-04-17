<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $ride = ['start' => 2, 'end' => 4];

        $trips_i_will_see = [];
        $trips_i_wont_see = [];

        $stations =  [1, 2, 3, 4];

        $stations_count = count($stations);

        for ($i = 0; $i < $stations_count; $i++) {
            for ($x = $i; $x < $stations_count; $x++) {
                if ($i == $x) {
                    continue;
                }

                if (
                    ($stations[$i] <= $ride['start'] && $stations[$x] <= $ride['start']) ||
                    ($stations[$i] >= $ride['end'] && $stations[$x] >= $ride['end'])
                ) {
                    $trips_i_wont_see[] = ['start' => $stations[$i], 'end' => $stations[$x]];
                    continue;
                }

                $trips_i_will_see[] = ['start' => $stations[$i], 'end' => $stations[$x]];
            }
        }

        dd($trips_i_will_see, $trips_i_wont_see);

        $trips = auth()->user()->load('trips', 'trips.pivot.pickup', 'trips.pivot.arrival')->trips;

        return view('home', compact('trips'));
    }
}

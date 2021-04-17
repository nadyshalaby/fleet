<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\BookingRequest;
use App\Includes\Booking;
use App\Models\Station;
use App\Models\Trip;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    use Booking;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Show a listing of user bookings.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bookings = auth('api')->user()->load('trips', 'trips.pivot.pickup', 'trips.pivot.arrival')->trips;

        return $this->success($bookings);
    }

    /**
     * Show a listing of available trips.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function trips(Request $request)
    {
        $trips = Trip::with(['stations' => fn ($q) => $q->orderBy('station_trip.stop_order')])->paginate(abs($request->per_page));

        return $this->success($trips);
    }


    /**
     * Get available seats number to the specified resource from storage.
     *
     * @param  TripRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function available(BookingRequest $request, Trip $trip)
    {
        if (!($user = $trip->users()->find(auth('api')->id()))) {
            $checked = $this->checkBooking($trip, Station::find($request->pickup_station_id), Station::find($request->arrival_station_id), 0);

            return $this->success(collect($checked)->except('can_book_a_seat'));
        } else {
            return $this->error([], "\"$user->name\" has already a booked seat.", 200);
        }
    }

    /**
     * Add booking to the specified resource from storage.
     *
     * @param  TripRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function book(BookingRequest $request, Trip $trip)
    {

        if (!($user = $trip->users()->find(auth('api')->id()))) {

            $checked = $this->checkBooking($trip, Station::find($request->pickup_station_id), Station::find($request->arrival_station_id), $request->seat_number);

            if ($checked['can_book_a_seat']) {
                $trip->users()->attach(auth('api')->id(), $request->only(['pickup_station_id', 'arrival_station_id', 'seat_number']));

                $bookings = auth('api')->user()->load('trips', 'trips.pivot.pickup', 'trips.pivot.arrival')->trips;

                return $this->success($bookings);
            }

            return $this->error($checked, 'Can\'t book this seat.');
        } else {
            return $this->error([], "\"$user->name\" has already a booked seat.", 200);
        }
    }
}

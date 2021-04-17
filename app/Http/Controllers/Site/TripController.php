<?php

namespace App\Http\Controllers\Site;

use App\DataTables\TripsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\TripRequest;
use App\Includes\Booking;
use App\Models\Station;
use App\Models\Trip;

class TripController extends Controller
{

    use Booking;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TripsDataTable $dataTable)
    {
        return $dataTable->render('pages.trip.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.trip.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    {
        $record = $request->all();

        $trip = Trip::create($record);

        return $this->success($trip);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        $trip->load(['stations' => fn ($q) => $q->orderBy('station_trip.stop_order')]);

        return view('pages.trip.stops', compact('trip'));
    }

    /**
     * Display the specified resource bookings.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookings(Trip $trip)
    {
        $trip->load(['users', 'stations' => fn ($q) => $q->orderBy('station_trip.stop_order'), 'users.pivot.pickup', 'users.pivot.arrival']);

        return view('pages.trip.bookings', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        return view('pages.trip.form', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TripRequest $request, Trip $trip)
    {
        $record = $request->all();

        $trip->update($record);

        return $this->success($trip);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();

        return back()->withSuccess('Record deleted successfully.');
    }

    /**
     * Add stop to the specified resource from storage.
     *
     * @param  TripRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addStop(TripRequest $request, Trip $trip)
    {
        if (!($station = $trip->stations()->find($request->station_id))) {
            $trip->stations()->attach($request->station_id, ['stop_order' => $request->stop_order]);

            $stations =  $trip->stations()->orderBy('station_trip.stop_order')->get();

            return $this->success($stations);;
        } else {
            return $this->error([], "\"$station->name\" has already been added before.", 200);
        }
    }

    /**
     * Remove stop from the specified resource from storage.
     *
     * @param  TripRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeStop(TripRequest $request, Trip $trip)
    {
        $trip->stations()->detach($request->station_id);

        $stations =  $trip->stations()->orderBy('station_trip.stop_order')->get();

        return $this->success($stations);;
    }



    /**
     * Add booking to the specified resource from storage.
     *
     * @param  TripRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addBooking(TripRequest $request, Trip $trip)
    {
        if (!($user = $trip->users()->find($request->user_id))) {

            $checked = $this->checkBooking($trip, Station::find($request->pickup_station_id), Station::find($request->arrival_station_id), $request->seat_number);

            if ($checked['can_book_a_seat']) {
                $trip->users()->attach($request->user_id, $request->only(['pickup_station_id', 'arrival_station_id', 'seat_number']));

                $users =  $trip->load('users', 'users.pivot.pickup', 'users.pivot.arrival')->users;

                return $this->success(compact('users', 'checked'));
            }

            return $this->success(compact('checked'));
        } else {
            return $this->error([], "\"$user->name\" has already a booked seat.", 200);
        }
    }

    /**
     * Remove booking from the specified resource from storage.
     *
     * @param  TripRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeBooking(TripRequest $request, Trip $trip)
    {
        $trip->users()->detach($request->user_id);

        $users =  $trip->load('users', 'users.pivot.pickup', 'users.pivot.arrival')->users;

        return $this->success($users);;
    }
}

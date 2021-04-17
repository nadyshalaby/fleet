<?php

namespace App\Includes;

use App\Models\Station;
use App\Models\Trip;

trait Booking
{
    /**
     * Check booking to the specified resource from storage.
     *
     * @param Trip $trip
     * @param Station $pickup
     * @param Station $arrival
     * @param int $seat_number
     * @return array
     */
    protected function checkBooking(Trip $trip, Station $pickup, Station $arrival, int $seat_number)
    {
        $ride = ['start' => $pickup->id, 'end' => $arrival->id];

        $trips_i_will_see = collect([]);
        $trips_i_wont_see = collect([]);

        $stations =  $trip->stations()->orderBy('station_trip.stop_order')->pluck('stations.id')->toArray();

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
                    // $trips_i_wont_see->push(['start' => $stations[$i], 'end' => $stations[$x]]);
                    continue;
                }

                $trips_i_will_see->push(['start' => $stations[$i], 'end' => $stations[$x]]);
            }
        }

        $booked_trips_i_will_see = $trip->users()
            ->wherePivotIn('pickup_station_id', array_unique($trips_i_will_see->pluck('start')->toArray()))
            ->wherePivotIn('arrival_station_id', array_unique($trips_i_will_see->pluck('end')->toArray()))
            ->get();

        $booked_seats_numbers = array_unique($booked_trips_i_will_see->pluck('pivot.seat_number')->toArray());

        $available_seats_numbers = array_diff(range(1, 12), $booked_seats_numbers);

        // Number of booked seats based on my booking trip.
        $booked_seats = $booked_trips_i_will_see->count();

        // Number of available seats based on my booking trip.
        $available_seats = 12 - $booked_seats;

        // Check if there's available seats and the target seat number not booked
        $can_book_a_seat = $available_seats > 0 && array_search($seat_number, $available_seats_numbers) !== false;

        return compact('booked_seats', 'booked_seats_numbers',  'available_seats', 'available_seats_numbers',  'can_book_a_seat');
    }
}

<?php

namespace App\Http\Requests\Site;

use App\Http\Requests\JsonFormRequest;

class TripRequest extends JsonFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->routeIs('trip.stop.add')) {
            return [
                'station_id' => ['required', 'exists:stations,id'],
                'stop_order' => ['required']
            ];
        }

        if ($this->routeIs('trip.stop.remove')) {
            return [
                'station_id' => ['required', 'exists:stations,id']
            ];
        }

        if ($this->routeIs('trip.booking.add', 'trip.booking.check')) {
            return [
                'user_id' => ['required', 'exists:users,id'],
                'pickup_station_id' => ['required', 'exists:stations,id'],
                'arrival_station_id' => ['required', 'exists:stations,id'],
                'seat_number' => ['required', 'numeric']
            ];
        }

        if ($this->routeIs('trip.booking.remove')) {
            return [
                'user_id' => ['required', 'exists:users,id']
            ];
        }

        return [
            'name' => ['required'],
        ];
    }
}

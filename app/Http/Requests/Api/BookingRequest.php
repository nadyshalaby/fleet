<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\JsonFormRequest;

class BookingRequest extends JsonFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if ($this->routeIs('booking.book')) {
            return [
                'pickup_station_id' => ['required', 'exists:stations,id'],
                'arrival_station_id' => ['required', 'exists:stations,id'],
                'seat_number' => ['required', 'numeric']
            ];
        }

        if ($this->routeIs('booking.available')) {
            return [
                'pickup_station_id' => ['required', 'exists:stations,id'],
                'arrival_station_id' => ['required', 'exists:stations,id'],
            ];
        }
    }
}

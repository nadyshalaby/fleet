<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TripUser extends Pivot
{

    public function pickup()
    {
        return $this->belongsTo(Station::class, 'pickup_station_id');
    }

    public function arrival()
    {
        return $this->belongsTo(Station::class, 'arrival_station_id');
    }
}

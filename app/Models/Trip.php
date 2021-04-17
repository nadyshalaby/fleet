<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory, EagerLoadPivotTrait;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function stations()
    {
        return $this->belongsToMany(Station::class)->withPivot('stop_order');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->using(TripUser::class)->withPivot(['pickup_station_id', 'arrival_station_id', 'seat_number']);
    }
}

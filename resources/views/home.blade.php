@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('My Bookings') }}</div>

                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover bg-white">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Trip</th>
                                    <th>Pickup</th>
                                    <th>Arrival</th>
                                    <th>Seat Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($trips as $trip)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $trip->name }}</td>
                                        <td>{{ $trip->pivot->pickup->name }}</td>
                                        <td>{{ $trip->pivot->arrival->name }}</td>
                                        <td>{{ orderSuffix($trip->pivot->seat_number) }} Seat</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No bookings yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

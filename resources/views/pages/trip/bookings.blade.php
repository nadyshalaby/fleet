@extends('layouts.app')

@section('content')
    <div class="container" x-data="FORMS.bookings({{ isset($trip) ? $trip->toJson() : 'undefined' }})" x-init="init">
        <!-- Modal -->
        <div class="modal fade" id="addBookingModal" role="dialog" aria-labelledby="addBookingModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBookingModalLabel">Bookings</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control users-data-ajax" placeholder="Selected Booking"
                                x-ref="selectedBooking" style="width:100%;"></select>
                        </div>
                        <div class="form-group">
                            <label>Pickup Station</label>
                            <select class="form-control" x-model="form.pickup_station_id">
                                <option value="">-- Select --</option>
                                <template x-for="station in form.stations" :key="station.id">
                                    <option :value="station.id" x-text="station.name"></option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Arrival Station</label>
                            <select class="form-control" x-model="form.arrival_station_id">
                                <option value="">-- Select --</option>
                                <template x-for="station in form.arrival_stations" :key="station.id">
                                    <option :value="station.id" x-text="station.name"></option>
                                </template>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Seat Number</label>
                            <select class="form-control" x-model="form.seat_number">
                                <option value="">-- Select --</option>
                                <template x-for="i in 12" :key="i">
                                    <option :value="i" x-text="order_suffix(i) + ' Seat'"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="addBooking">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <h3 x-text="title" class="timeline-heading text-center"></h3>
        <div class="main-timeline">
            <div class="timeline text-center">
                <button class="btn btn-icon btn-create" data-toggle="modal" data-target="#addBookingModal">&plus;</button>
            </div>
            <table class="table table-striped table-bordered table-hover bg-white">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Passenger</th>
                        <th>Pickup</th>
                        <th>Arrival</th>
                        <th>Seat Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-for="(user, index) in form.users" :key="index">
                        <!-- start section-->
                        <tr>
                            <td x-text="index + 1"></td>
                            <td x-text="user.name"></td>
                            <td x-text="user.pivot.pickup.name"></td>
                            <td x-text="user.pivot.arrival.name"></td>
                            <td x-text="order_suffix(user.pivot.seat_number) + ' Seat'"></td>
                            <td>
                                <button class="btn btn-link text-danger"
                                    @click.prevent="removeBooking(user.id)">Remove</button>
                            </td>
                        </tr>
                        <!-- end section-->
                    </template>
                    <template x-if="!form.users.length">
                        <tr>
                            <td colspan="5" class="text-center">
                                No bookings yet.
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

    </div>
@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .main-timeline::before {
            content: unset !important;
        }

    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

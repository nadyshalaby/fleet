@extends('layouts.app')

@section('content')
    <div class="container" x-data="FORMS.stops({{ isset($trip) ? $trip->toJson() : 'undefined' }})" x-init="init">
        <!-- Modal -->
        <div class="modal fade" id="addStopModal" role="dialog" aria-labelledby="addStopModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStopModalLabel">Stops</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control stations-data-ajax" placeholder="Selected Stop" x-ref="selectedStop"
                                style="width:100%;"></select>
                        </div>
                        <div class="form-group">
                            <input type="number" x-ref="stopOrder" min="0" placeholder="Stop Order" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="addStop">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <h3 x-text="title" class="timeline-heading text-center"></h3>
        <div class="main-timeline">
            <div class="timeline text-center">
                <button class="btn btn-icon btn-create" data-toggle="modal" data-target="#addStopModal">&plus;</button>
            </div>
            <template x-for="(station, index) in form.stations" :key="index">
                <!-- start experience section-->
                <div class="timeline">
                    <div class="icon"></div>
                    <div class="date-content">
                        <div class="date-outer">
                            <span class="date">
                                <span class="month" x-text="order_suffix(index + 1)"></span>
                                <span class="year">Station</span>
                            </span>
                        </div>
                    </div>
                    <div class="timeline-content">
                        <a href="#" class="text-danger rounded" @click.prevent="removeStop(station.id)">&times;</a>
                        <h5 class="title" x-text="station.name"></h5>
                        <p class="description" x-text="station.notes">
                        </p>
                    </div>
                </div>
                <!-- end experience section-->
            </template>
        </div>

    </div>
@endsection
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

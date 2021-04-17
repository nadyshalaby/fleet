<script>
    window.API = {
        user: {
            index: "{{ route('user.index') }}",
            store: "{{ route('user.store') }}",
            update: "{{ route('user.update', ['user' => 'ID']) }}"
        },
        station: {
            index: "{{ route('station.index') }}",
            store: "{{ route('station.store') }}",
            update: "{{ route('station.update', ['station' => 'ID']) }}"
        },
        trip: {
            index: "{{ route('trip.index') }}",
            store: "{{ route('trip.store') }}",
            update: "{{ route('trip.update', ['trip' => 'ID']) }}",
            addStop: "{{ route('trip.stop.add', ['trip' => 'ID']) }}",
            removeStop: "{{ route('trip.stop.remove', ['trip' => 'ID']) }}",
            addBooking: "{{ route('trip.booking.add', ['trip' => 'ID']) }}",
            removeBooking: "{{ route('trip.booking.remove', ['trip' => 'ID']) }}",
        },
    };

</script>

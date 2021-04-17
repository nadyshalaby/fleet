<a href="{{ route('trip.show', $id) }}" class="text-secondary">Stops</a>
<br>
<a href="{{ route('trip.bookings', $id) }}" class="text-secondary">Bookings</a>
<hr>
<a href="{{ route('trip.edit', $id) }}">Edit</a>
<br>
<form action="{{ route('trip.destroy', $id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-danger btn btn-link"
        onclick="return confirm('Do you confirm delete this record?')">Delete</button>
</form>

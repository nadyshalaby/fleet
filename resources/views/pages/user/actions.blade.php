<a href="{{ route('user.edit', $id) }}">Edit</a>
<br>
<form action="{{ route('user.destroy', $id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-danger btn btn-link"
        onclick="return confirm('Do you confirm delete this record?')">Delete</button>
</form>

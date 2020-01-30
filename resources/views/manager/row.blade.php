<tr>
    <th scope="row">{{ $newsRecord->id }}</th>
    <td>
            {{ $newsRecord->title }}
    </td>
    <td>{{ $newsRecord->category->name }}</td>
    <td>{{ $newsRecord->created_at }}</td>
    <td>
        <button type="button" data-target="#newsEditModal" data-id="{{ $newsRecord->id }}" class="btn btn-primary" data-toggle="modal">
            Edit
        </button>
    </td>
    <td>
        <button type="button" data-target="#newsDeleteModal" data-id="{{ $newsRecord->id }}" class="btn btn-primary" data-toggle="modal">
            Delete
        </button>
    </td>
</tr>

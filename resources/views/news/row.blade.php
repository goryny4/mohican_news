<tr>
    <th scope="row">{{ $newsRecord->id }}</th>
    <td>
        <button type="button" data-target="#newsTextModal" data-id="{{ $newsRecord->id }}" class="btn btn-primary" data-toggle="modal">
            {{ $newsRecord->title }}
        </button>
    </td>
    <td>{{ $newsRecord->category->name }}</td>
    <td>{{ $newsRecord->created_at }}</td>
</tr>

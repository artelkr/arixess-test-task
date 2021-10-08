<x-app-layout>
    <h1>Admin Panel</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>File</th>
                <th>Created At</th>
                <th>Replied At</th>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            @forelse($feedbacks as $feedback)
            <tr>
                <th>{{ $feedback->id }}</th>
                <td>{{ $feedback->subject }}</td>
                <td>{{ $feedback->message }}</td>
                <td>{{ $feedback->user->name }}</td>
                <td>{{ $feedback->user->email }}</td>
                <td>
                    @if(!blank($feedback->file_path))
                    <a href="{{ Storage::url($feedback->file_path) }}">Attachment</a>
                    @endif
                </td>
                <td>{{ $feedback->created_at }}</td>
                <td>
                    @if($feedback->manager)
                    {{ $feedback->viewed_at }} (by {{ $feedback->manager->name }})
                    @endif
                </td>
                <td>
                    @if($feedback->manager === null)
                    <form action="{{ route('reply-to-feedback', [$feedback]) }}" method="post">
                        @csrf

                        <button type="submit">Reply</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9">Empty...</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</x-app-layout>

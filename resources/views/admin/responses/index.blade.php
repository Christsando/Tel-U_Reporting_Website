<x-app-layout>
    <div class="container">
        <h1>Daftar Respon Admin</h1>

        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Message</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($responses as $response)
                    <tr>
                        <td>{{ $response->id }}</td>
                        <td>{{ Str::limit($response->message, 50) }}</td>
                        <td>{{ $response->respondable_type }}</td>
                        <td>{{ $response->action_status ?? '-' }}</td>
                        <td>
                            <a href="{{ route('responses.show', $response->id) }}">Detail</a>
                            |
                            <a href="{{ route('responses.edit', $response->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $responses->links() }}
    </div>
</x-app-layout>

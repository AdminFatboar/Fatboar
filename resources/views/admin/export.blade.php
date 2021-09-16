<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Win Count</th>
    </tr>
    </thead>
    <tbody>
    @foreach($win_nonwin_results as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->ticket_count }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
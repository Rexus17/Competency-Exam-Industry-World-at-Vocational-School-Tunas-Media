<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Username</th>
        <th>Password</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $u)
        <tr>
            <td>{{ $u->nama }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->password }}</td>
            <td>{{ $u->role }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
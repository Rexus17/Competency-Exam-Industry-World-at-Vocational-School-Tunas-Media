<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $m)
        <tr>
            <td>{{ $m->nama }}</td>
            <td>{{ $m->alamat }}</td>
            <td>{{ $m->jenis_kelamin }}</td>
            <td>{{ $m->tlp }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
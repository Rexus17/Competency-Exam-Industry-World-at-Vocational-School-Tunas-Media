<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Address</th>
        <th>Phone</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $o)
        <tr>
            <td>{{ $o->nama }}</td>
            <td>{{ $o->alamat }}</td>
            <td>{{ $o->tlp }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
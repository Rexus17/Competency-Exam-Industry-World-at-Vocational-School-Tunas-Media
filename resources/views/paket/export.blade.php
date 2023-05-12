<table>
    <thead>
    <tr>
        <th>Package Name</th>
        <th>Type</th>
        <th>Price</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $p)
        <tr>
            <td>{{ $p->nama_paket }}</td>
            <td>{{ $p->jenis }}</td>
            <td>{{ $p->harga }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
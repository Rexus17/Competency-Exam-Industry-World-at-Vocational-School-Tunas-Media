@include('partials.header')

<div class="container">
    <div class="row">
        @if(auth()->User()->role != null && auth()->User()->role != 'owner')
        <div class="col-md-12 mb-4">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Input Package Data</h3>
                </div>
                <form action="/paket/prosestambah" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Outlets</label>
                            <div class="col-sm-9">
                                <select name="id_outlet" class="form-control" id="">
                                    <option value="" selected disabled>Select Outlet</option>
                                    @foreach ($datao as $name)
                                    <option value="{{ $name->id}}">{{ $name->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="nama_paket" id="nama">
                                <input type="text" class="form-control" name="nama_paket" id="nama_paket"
                                    placeholder="Package Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Type</label>
                            <div class="col-sm-9">
                                <select name="jenis" id="jenis" class="form-control" required>
                                    <option selected disabled>Select Type Package</option>
                                    <option value="kiloan">Kiloan</option>
                                    <option value="selimut">Selimut</option>
                                    <option value="bad cover">Bad Cover</option>
                                    <option value="kaos">Kaos</option>
                                    <option value="lain">Lain</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row username">
                            <label for="username" class="col-sm-3 col-form-label">Price</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="harga" id="harga"
                                    placeholder="Package Price" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Insert</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif

        <div class="col-md-12 mb-4">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Packages Data</h3>
                    {{-- <form action="" method="GET" role="search">
                        <div class="input-group mb-2 col-md-6 mx-auto pull-right">
                            <span class="input-group-btn mr-3 mt-1">
                                <button class="btn btn-info text-uppercase text-white" type="submit" title="Search projects">
                                    <span class="fas fa-search"> Search</span>
                                </button>
                            </span>
                            <input type="text" class="form-control mt-1 mr-2" name="search_outlet" placeholder="Search Packages" id="search_outlet">
                            <a href="{{ route('projects.index') }}" class=" mt-1">
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button" title="Refresh page">
                                        <span class="fas fa-sync-alt"></span>
                                    </button>
                                </span>
                            </a>
                        </div>
                    </form> --}}
                </div>
                <div class="card-body">
                    @if(session() -> exists('alert'))
                    <div class="alert alert-{{session()->get('alert') ['bg']}} alert-dismissible fade show"
                        role="alert">
                        {{session()-> get('alert')['message']}}
                    </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Outlet</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                @if(auth()->User()->role != null && auth()->User()->role != 'owner')
                                <th style="width: 15%">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tbl_paket as $i => $paket)
                            <tr>
                                <td>{{ $paket->id }}</td>
                                <td>{{ $paket->outlet->nama}}</td>
                                <td>{{ $paket->nama_paket }}</td>
                                <td>{{ $paket->jenis }}</td>
                                <td>{{ $paket->harga }}</td>
                                @if(auth()->User()->role != null && auth()->User()->role != 'owner')
                                <td>
                                    <div class="button">
                                        <a href="javascript:;" data-toggle="modal" data-target="#modalEdit{{ $i }}"
                                            class="btn btn-warning"><i class="fa fa-edit"> Edit</i></a>
                                        <a href="{{url('/paket/delete/' .$paket -> id)}}" class="btn btn-danger"><i
                                                class="fa fa-trash"> Delete</i></a>
                                    </div>
                                </td>
                                @endif
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    {{-- <a href="{{ url('paket/export') }}" class="btn btn-success" target="_blank">Export to Excel</a> --}}

                    {{$tbl_paket->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($tbl_paket as $i => $paket)
<div class="modal fade" id="modalEdit{{ $i }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/paket/edit/edit-paket/' . $paket->id) }}">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama_paket" class="form-control" placeholder="Nama"
                            value="{{ $paket->nama_paket }}" required>
                    </div>
                    <div class="form-group">
                        <label>Now Outlet</label>
                        <input type="text" name="id_outlet" class="form-control" placeholder="Outlet"
                            value="{{ $paket->outlet->nama }}" required readonly>
                        <label class="mt-2">New Outlet</label>
                        <select name="id_outlet" class="form-control" id="">
                            <option value="" selected disabled>Select Outlets</option>
                            @foreach ($datao as $name)
                                <option value="{{ $name->id}}">{{ $name->nama}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jenis</label>
                        <input type="text" name="jenis" class="form-control" placeholder="Jenis Paket"
                            value="{{ $paket->jenis }}" required>
                    </div>

                    <div class="form-group">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" placeholder="Harga Paket"
                            value="{{ $paket->harga }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach


@include('partials.footer')

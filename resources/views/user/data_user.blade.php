@include('partials.header')

<div class="container">
    <div class="row">
        @if(auth()->User()->role != null && auth()->User()->role != 'owner')
        <div class="col-md-12 mb-4">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Input Data User</h3>
                </div>
                <form action="/user/prosestambah" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="nama" id="nama">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="username" id="username" placeholder="Username"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="password" id="password" placeholder="Password"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Outlet</label>
                            <div class="col-sm-9">
                                <select name="id_outlet" class="form-control" id="">
                                    <option value="" selected disabled>Select Outlets</option>
                                    @foreach ($datao as $name)
                                        <option value="{{ $name->id}}">{{ $name->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Users</label>
                            <div class="col-sm-9">
                            <select name="role" class="form-control" id="">
                                <option value="" selected disabled>Select Users</option>
                                <option value="admin" >Admin</option>
                                <option value="kasir" >Kasir</option>
                                <option value="owner" >Owner</option>
                            </select>
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
                    <h3 class="card-title">Users Data</h3>
                    {{-- <form action="" method="GET" role="search">
                        <div class="input-group mb-2 col-md-6 mx-auto pull-right">
                            <span class="input-group-btn mr-3 mt-1">
                                <button class="btn btn-info text-uppercase text-white" type="submit" title="Search projects">
                                    <span class="fas fa-search"> Search</span>
                                </button>
                            </span>
                            <input type="text" class="form-control mt-1 mr-2" name="search_outlet" placeholder="Search Users" id="search_outlet">
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
                    <div class="alert alert-{{session()->get('alert') ['bg']}} alert-dismissible fade show"role="alert">
                        {{session()-> get('alert')['message']}}
                    </div>
                    @endif
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Outlet</th>
                                <th>Type</th>
                                @if(auth()->User()->role != null && auth()->User()->role != 'owner')
                                <th style="width: 15%">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tbl_user as $i => $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->password }}</td>
                                <td>{{ $user->outlet->nama}}</td>
                                <td>{{ $user->role }}</td>
                                @if(auth()->User()->role != null && auth()->User()->role != 'owner')
                                <td>
                                    <div class="button">
                                        <a href="javascript:;" data-toggle="modal" data-target="#modalEdit{{ $i }}"
                                            class="btn btn-warning"><i class="fa fa-edit"> Edit</i></a>
                                        <a href="{{url('/user/delete/' .$user->id)}}"
                                            class="btn btn-danger"><i class="fa fa-trash"> Delete</i></a>
                                    </div>
                                </td>
                                @endif
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    {{-- <a href="{{ url('user/export') }}" class="btn btn-success" target="_blank">Export to Excel</a> --}}

                    {{$tbl_user->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($tbl_user as $i => $user)
    <div class="modal fade" id="modalEdit{{ $i }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('/user/edit/edit-user/' . $user->id) }}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $user->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" placeholder="username" value="{{ $user->username }}" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="username" value="{{ $user->password }}" required>
                        </div>
                        <div class="form-group">
                            <label>Now Outlet</label>
                            <input type="" name="id_outlet" class="form-control" placeholder="Outlet" value="{{ $user->outlet->nama }}" required readonly>
                            <label class="mt-2">New Outlet</label>
                            <select name="id_outlet" class="form-control" id="">
                                <option value="" selected disabled>Select Outlets</option>
                                @foreach ($datao as $name)
                                    <option value="{{ $name->id}}">{{ $name->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Now As</label>
                            <input type="role" name="role" class="form-control" placeholder="Bagian" value="{{ $user->role }}" required readonly>
                            <label class="mt-2">New As</label>
                            <select type="role" name="role" class="form-control" id="">
                                <option value="" selected disabled>Select Users</option>
                                <option value="admin" >Admin</option>
                                <option value="kasir" >Kasir</option>
                                <option value="owner" >Owner</option>
                            </select>
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

@include('partials.header')

<div class="container">
    <div class="row">
        @if(auth()->User()->role != null && auth()->User()->role != 'owner')
        <div class="col-md-12 mb-4">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Input Member Data</h3>
                </div>
                <form action="/member/prosestambah" method="post" enctype="multipart/form-data">
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
                            <label for="alamat" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="alamat" id="alamat" placeholder="Address"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-3 col-form-label">Gender</label>
                            <div class="col-sm-9">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" class="jk" id="jenis_kelamin" name="jenis_kelamin"
                                            value="Pria" checked>
                                        <label for="jk1">Male
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" class="jk" id="jenis_kelamin" value="Wanita"
                                            name="jenis_kelamin">
                                        <label for="jk2">Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="status" class="col-sm-3 col-form-label">Status</label>
                            <div class="col-sm-9">
                            <select name="status" class="form-control" id="">
                                <option value="" selected disabled>Select Status</option>
                                <option value="member" >Member</option>
                                <option value="customer">Customer</option>
                            </select>
                            </div>
                        </div> --}}
                        <div class="form-group row username">
                            <label for="username" class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="tlp" id="tlp" placeholder="Phone"
                                    required>
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
                    <h3 class="card-title">Members Data</h3>
                    {{-- <form action="" method="GET" role="search">
                        <div class="input-group mb-2 col-md-6 mx-auto pull-right">
                            <span class="input-group-btn mr-3 mt-1">
                                <button class="btn btn-info text-uppercase text-white" type="submit" title="Search projects">
                                    <span class="fas fa-search"> Search</span>
                                </button>
                            </span>
                            <input type="text" class="form-control mt-1 mr-2" name="search_outlet" placeholder="Search Members" id="search_outlet">
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">Id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Gender</th>
                                {{-- <th>Status</th> --}}
                                <th>Phone</th>
                                @if(auth()->User()->role != null && auth()->User()->role != 'owner')
                                <th style="width: 15%">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tbl_member as $i => $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>{{ $member->nama }}</td>
                                <td>{{ $member->alamat }}</td>
                                <td>{{ $member->jenis_kelamin }}</td>
                                {{-- <td>{{ $member->status }}</td> --}}
                                <td>{{ $member->tlp }}</td>
                                @if(auth()->User()->role != null && auth()->User()->role != 'owner')
                                <td>
                                    <div class="button">
                                        <a href="javascript:;" data-toggle="modal" data-target="#modalEdit{{ $i }}"
                                            class="btn btn-warning"><i class="fa fa-edit"> Edit</i></a>
                                        <a href="{{url('/member/delete/' .$member -> id)}}"
                                            class="btn btn-danger"><i class="fa fa-trash"> Delete</i></a>
                                    </div>
                                </td>
                                @endif
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    {{-- <a href="{{ url('member/export') }}" class="btn btn-success" target="_blank">Export to Excel</a> --}}

                    {{$tbl_member->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($tbl_member as $i => $member)
    <div class="modal fade" id="modalEdit{{ $i }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Member</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('/member/edit/edit-member/' . $member->id) }}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $member->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $member->alamat }}" required>
                        </div>
                        <div class="form-group row">
                            <label>Gender Now</label>
                            <input type="text" name="jk" class="form-control" placeholder="Jenis Kelamin" value="{{ $member->jenis_kelamin }}" required readonly>
                            <label for="jk" class="col-sm-3 col-form-label">Gender New</label>
                            <div class="col-sm-9">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" class="jk" id="jenis_kelamin" name="jenis_kelamin"
                                            value="Pria" checked>
                                        <label for="jk1">Male
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" class="jk" id="jenis_kelamin" value="Wanita"
                                            name="jenis_kelamin">
                                        <label for="jk2">Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                        <label for="">Gender</label>
                            <select name="jenis_kelamin" class="form-control" required>
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Laki-Laki" {{ $member->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="Perempuan" {{ $member->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>Status Now</label>
                            <input type="text" name="status" class="form-control" placeholder="Bagian" value="{{ $member->status }}" required readonly>
                            <label class="mt-2">Status New</label>
                            <select type="status" name="status" class="form-control" id="">
                                <option value="" selected disabled>Select Status</option>
                                <option value="member" >Member</option>
                                <option value="customer">Customer</option>
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" name="tlp" class="form-control" placeholder="No Telfon" value="{{ $member->tlp }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


@include('partials.footer')

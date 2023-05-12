<?php
    $invoice = 'DRY'.Date('Ymdsi');
?>

@include('partials.header')

<section>
    <div class="container-fluid mt-5">
        <div class="row" ng-app="app" ng-controller="transaksiController">
            @if(auth()->User()->role != null && auth()->User()->role != 'owner')
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Input Transaction</h3>
                    </div>
                    <form action="{{ url('/transaksi/prosestambah') }}"method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="kode_invoice" class="col-sm-4 col-form-label">Kode Invoice</label>
                                <div class="col-sm-8">
                                    <input type="text" name="kode_invoice" class="form-control" readonly="" value="<?= $invoice ?>">
                                    <input type="hidden" name="id_user" class="form-control" value="<?= Session::get('id_user') ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label">Nama Toko</label>
                                <div class="col-sm-8">
                                    <select name="id_outlet" class="form-control" id="">
                                        <option value="" selected disabled>Pilih Toko</option>
                                        @foreach ($dataoutlet as $i)
                                        <option value="{{ $i->id}}">{{ $i->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label">Nama Anggota</label>
                                <div class="col-sm-8">
                                    <select name="id_member" class="form-control" id="">
                                        <option value="" selected disabled>Pilih Anggota</option>
                                        @foreach ($datamember as $i)
                                        <option value="{{ $i->id}}">{{ $i->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="id" class="col-sm-4 col-form-label">Nama Paket</label>
                                <div class="col-sm-8">
                                    <select name="jenis" id="jenis" class="form-control" required>
                                        <option selected disabled>Pilih Jenis Paket</option>
                                        <option value="kiloan">Kiloan</option>
                                        <option value="selimut">Selimut</option>
                                        <option value="bad cover">Bad Cover</option>
                                        <option value="kaos">Kaos</option>
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="form-group row">
                                <label for="tgl_ambil" class="col-sm-4 col-form-label">Jumlah</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="qty" id="qty" value="0" required>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="tgl" class="col-sm-4 col-form-label">Tanggal Transaksi</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tgl" id="tgl" min="<?= date('Y-m-d H:i:s') ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_bayar" class="col-sm-4 col-form-label">Tanggal Bayar</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="tgl_bayar" id="tgl_bayar" min="<?= date('Y-m-d H:i:s') ?>" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="batas_waktu" class="col-sm-4 col-form-label">Batas Waktu</label>
                                <div class="col-sm-8">
                                    <input type="date" class="form-control" name="batas_waktu" id="batas_waktu" min="<?= date('Y-m-d H:i:s') ?>" required>
                                </div>
                            </div>
                            
                            {{-- <div class="form-group row">
                                <label for="harga" class="col-sm-4 col-form-label">Harga</label>
                                <div class="col-sm-8">
                                    <input id="harga" type="number" value="0" name="harga" class="form-control" > 
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="tgl_ambil" class="col-sm-4 col-form-label">Biaya Tambahan</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="biaya_tambahan" id="pajak" placeholder="Rp"
                                    required value="0">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_ambil" class="col-sm-4 col-form-label">Diskon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="diskon" id="diskon" value="0" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tgl_ambil" class="col-sm-4 col-form-label">Pajak</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="pajak" id="pajak" placeholder="Rp"
                                        required value="0">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="status" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                    <select name="status" id="status" class="form-control" required>
                                        <option selected disabled>Pilih Status Transaksi</option>
                                        <option value="baru">Baru</option>
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="diambil">Diambil</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Transaction</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Clear</button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            @if(auth()->User()->role != null && auth()->User()->role != 'owner')
            <div class="row justify-content-center mt-4" id="paket">
                <div class="col-md-10">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Add Package</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <td>Action</td>
                                        <th>Nama Paket</th>
                                        <th>Jumlah</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <button type="button" id="addPaket" class="btn btn-success">Add Package</button>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <select name="id_paket[]" id="" class="form-control" required>
                                                        <option selected disabled>Pilih Nama Paket</option>
                                                        @foreach($datapaket as $dp)
                                                        <option value="{{ $dp -> id }}">{{ $dp -> nama_paket }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control"name="qty[]" placeholder="Quantity">
                                        </td>
                                        <td>
                                            <input type="textarea" class="form-control" name="keterangan[]" placeholder="Notes">
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- <div class="col-md-12 mt-5">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Data Transaksi</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 30px">Id Transaksi</th>
                                    <th>Status</th>
                                    <th>Status Bayar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas.transaksi  | orderBy: '-kd_pemesanan'">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div class="card-footer justify-content-between">
                                            <button type="submit" class="btn btn-danger">Clear</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
            <section id="table-transaksi">
                <div class="container-fluid mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold ">Transaction Data Table</h6>
                        </div>

                        <div class="card-body">

                            @if(session()->exists('alert'))
                            <div class="alert alert-{{ session()->get('alert')['bg'] }} alert-dismissible fade show"
                                role="alert">
                                {{ session()->get('alert')['message'] }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach($errors->all() as $error )
                                {{ $error }}
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Transaksi</th>
                                            <th>Kode Invoice</th>
                                            <th>Nama Toko</th>
                                            <th>Nama Anggota</th>
                                            {{-- <th>Nama Paket</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th> --}}
                                            <th>Tanggal Transaksi</th>
                                            <th>Batas Waktu</th>
                                            <th>Tanggal Bayar</th>
                                            <th>Biaya Tambahan</th>
                                            <th>Diskon</th>
                                            <th>Pajak</th>
                                            <th>Status</th>
                                            <th>Dibayar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(count($transaksi) == 0)
                                        <tr>
                                            <td colspan="14" class="text-center bg-danger text-white">
                                                Data Tidak Data!
                                            </td>
                                        </tr>
                                        @endif

                                        @foreach($transaksi as $index => $dataTransaksi)
                                        <tr>
                                            <td>{{ $index + $transaksi->firstItem() }}</td>
                                            <td>{{ $dataTransaksi->id}}</td>
                                            <td>{{ $dataTransaksi->kode_invoice }}</td>
                                            <td>{{ $dataTransaksi->outlet->nama}}</td>
                                            <td>{{ $dataTransaksi->member->nama }}</td>
                                            {{-- <td>{{ $dataTransaksi->datapaket->id }} - {{ $dataTransaksi->datapaket->nama_paket }}</td> --}}
                                            <td>{{ $dataTransaksi->tgl }}</td>
                                            <td>{{ $dataTransaksi->batas_waktu }}</td>
                                            <td>{{ $dataTransaksi->tgl_bayar }}</td>
                                            <td>{{ $dataTransaksi->biaya_tambahan }}</td>
                                            <td>{{ $dataTransaksi->diskon }}% </td>
                                            <td>{{ $dataTransaksi->pajak }}% </td>
                                            <td class="text-dark">{{ $dataTransaksi->status }}</td>
                                            <td class="text-dark">{{ $dataTransaksi->dibayar }}</td>

                                            <td>
                                                <button class="btn btn-success btn-sm rounded mb-1" data-toggle="modal"
                                                    data-target="#ModalEditTransaksi{{ $index }}">
                                                    <i class="fa fa-edit">Edit</i>
                                                </button>

                                                <a class="btn btn-warning btn-sm rounded mb-1"
                                                    href="{{ url('/transaksi/detail_transaksi/' . $dataTransaksi->id) }}">
                                                    <i class="fa fa-edit">Detail</i>
                                                </a>

                                                <a class="btn btn-danger btn-sm rounded mb-1"
                                                    href="{{ url('/transaksi/detail_transaksi/' . $dataTransaksi->id) }}">
                                                    <i class="fa fa-trash">Delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Total ada {{ $transaksi->total() }} Data Paket
                                <div class="d-flex justify-content-end">
                                    {{ $transaksi->links() }}
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

@if(auth()->User()->role != null && auth()->User()->role != 'owner')
@foreach($transaksi as $index => $a)
<div class="modal fade" id="ModalEditTransaksi{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Edit Transaksi</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/transaksi/edit/edit-transaksi/' . $a->id) }}" method="post">
                @csrf
                <div class="modal-body">

                    {{-- <div class="form-floating mb-3">
                        <button disabled class="badge badge-primary">Id Transaksi</button>
                        <input type="text" class="form-control" value="{{ $a->id }}" readonly>
                    </div>

                    <div class="form-floating mb-3">
                        <button disabled class="badge badge-success mb-1">Status</button>
                        <select name="status" class="form-control d-flex justify-content-center">
                            <option value="baru" {{ $a->status == 'baru' ? 'selected' : '' }} class="text-secondary">
                                Baru</option>
                            <option value="proses" {{ $a->status == 'proses' ? 'selected' : '' }} class="text-dark">
                                Proses</option>
                            <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}
                                class="text-primary">Selesai</option>
                            <option value="diambil" {{ $a->status == 'diambil' ? 'selected' : '' }}
                                class="text-success">Diambil</option>
                        </select>
                    </div>

                    <div class="form-floating mb-3">
                        <button disabled class="badge badge-secondary mb-1">Dibayar</button>
                        <select name="dibayar" class="form-control">
                            <option value="dibayar" {{ $a->dibayar == 'dibayar' ? 'selected' : '' }}
                                class="text-success">Dibayar</option>
                            <option value="belum_dibayar" {{ $a->dibayar == 'belum_dibayar' ? 'selected' : '' }}
                                class="text-danger">Belum Dibayar</option>
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label>ID Transaksi</label>
                        <input type="text" name="id" class="form-control" placeholder="ID Transaksi" value="{{ $a->id }}" readonly>
                    </div>

                    <div class="form-group">
                        <label>Kode Invoice</label>
                        <input type="text" name="kode_invoice" class="form-control" placeholder="Kode Invoice" value="{{ $a->kode_invoice }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Toko Sekarang</label>
                        <input type="" name="id_outlet" class="form-control" placeholder="Outlet" value="{{ $a->outlet->nama }}" readonly>
                        <label class="mt-2">Toko Baru</label><br>
                        <label for="id" class="col-sm-12 col-form-label"># Pilih Toko Baru</label>
                        <div class="col-sm-12">
                            <select name="id_outlet" class="form-control" id="">
                                <option value="" selected disabled>Pilih Toko</option>
                                @foreach ($dataoutlet as $i)
                                <option value="{{ $i->id}}">{{ $i->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nama Anggota Sekarang</label>
                        <input type="" name="id_anggota" class="form-control" placeholder="Outlet" value="{{ $a->member->nama }}" readonly>
                        <label class="mt-2">Nama Anggota Baru</label><br>
                        <label for="id" class="col-sm-12 col-form-label"># Pilih Nama Anggota Baru</label>
                        <div class="col-sm-12">
                            <select name="id_anggota" class="form-control" id="">
                                <option value="" selected disabled>Pilih Nama Anggota Baru</option>
                                @foreach ($datamember as $i)
                                <option value="{{ $i->id}}">{{ $i->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Transaksi Sekarang</label>
                        <input type="" name="id_transaksi" class="form-control" placeholder="Outlet" value="{{ $a->tgl }}" required readonly>
                        <label class="mt-2">Tanggal Transaksi Baru</label><br>
                        <label for="id" class="col-sm-12 col-form-label"># Pilih Tanggal Transaksi Baru</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" name="tgl" id="tgl" min="<?= date('Y-m-d H:i:s') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Batas Waktu Sekarang</label>
                        <input type="" name="id_transaksi" class="form-control" placeholder="Outlet" value="{{ $a->batas_waktu }}" readonly>
                        <label class="mt-2">Batas Waktu Baru</label><br>
                        <label for="id" class="col-sm-12 col-form-label"># Pilih Batas Waktu Baru</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" name="batas_waktu" id="batas_waktu" min="<?= date('Y-m-d H:i:s') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Bayar Sekarang</label>
                        <input type="" name="id_transaksi" class="form-control" placeholder="Outlet" value="{{ $a->tgl_bayar }}" required readonly>
                        <label class="mt-2">Tanggal Bayar Baru</label><br>
                        <label for="id" class="col-sm-12 col-form-label"># Pilih Tanggal Bayar Baru</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control" name="tgl_bayar" id="tgl_bayar" min="<?= date('Y-m-d H:i:s') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Biaya Tambahan</label>
                        <input type="number" name="biaya_tambahan" class="form-control" placeholder="Biaya Tambahan" value="{{ $a->biaya_tambahan }}" required>
                    </div>
                    <div class="form-group">
                        <label>Diskon</label>
                        <input type="number" name="diskon" class="form-control" placeholder="Biaya Tambahan" value="{{ $a->diskon }}" required>
                    </div>
                    <div class="form-group">
                        <label>Status Sekarang</label>
                        <input type="" name="id_transaksi" class="form-control" placeholder="Status" value="{{ $a->status }}" readonly>
                        <label class="mt-2">Status Baru</label><br>
                        <label for="status" class="col-sm-12 col-form-label"># Pilih Status Baru</label>
                        <div class="col-sm-12">
                            <select name="status" id="status" class="form-control" required>
                                <option selected disabled>Pilih Status Transaksi</option>
                                <option value="baru">Baru</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="diambil">Diambil</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status Pembayaran Sekarang</label>
                        <input type="" name="id_transaksi" class="form-control" placeholder="Status Pembayaran" value="{{ $a->dibayar }}" required readonly>
                        <label class="mt-2">Status Baru</label><br>
                        <label for="dibayar" class="col-sm-12 col-form-label"># Pilih Status Pembayaran Baru</label>
                        <div class="col-sm-12">
                            <select for="dibayar" name="dibayar" id="id_transaksi" class="form-control" required>
                                <option selected disabled>Pilih Status Pembayaran</option>
                                <option value="dibayar">Di Bayar</option>
                                <option value="belum_dibayar">Belum Di Bayar</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="form-group row">
                        <label>Gender Now</label>
                        <input type="text" name="jk" class="form-control" placeholder="Jenis Kelamin" value="{{ $a->jenis_kelamin }}" required readonly>
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

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" name="tlp" class="form-control" placeholder="No Telfon" value="{{ $a->tlp }}" required>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success">SIMPAN
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif

@include('partials.footer')
<script>
    function deletePaket(i) {
        $(`.paket-item-${i}`).remove();
    }

    $(function () {
        let paket = 2;

        $('#addPaket').click(function () {
            $('#paket').append(`

            <div class="col-md-8 mt-3 paket-item-${paket}">
                 <label for="">
                        Nama Paket*
                        <i class="fas fa-trash-alt ml-2 text-danger" onclick="deletePaket('${paket}')"></i>
                    </label>
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Tambah paket</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th>Nama Paket</th>
                                        <th>Qty</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <select name="id_paket[]" class="form-control" required>
                                                        ${ $('[name*=id_paket]').html() }
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="qty[]"class="form-control">
                                        </td>
                                        <td>
                                            <input type="textarea" name="keterangan" class="form-control" placeholder="">
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

        `);

            paket++;
        });


    });

</script>

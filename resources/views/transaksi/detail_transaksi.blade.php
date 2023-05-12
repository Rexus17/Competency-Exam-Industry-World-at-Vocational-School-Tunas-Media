<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ url('assets/assetss/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/assetss/js/7fdd60d3a4.js') }}">
    <link href="{{ url('assets/assetss/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <title>DETAIL TRANSAKSI</title>
</head>

<body>
    <section id="table-detail">
        <div class="container-fluid">
            <a href="{{ url('/transaksi/data_transaksi') }}"
                class="btn btn-warning mt-3 text-white shadow">BACK</a>
            <div class="card text-center shadow mb-4 mt-5">
                <div class="card-header py-3">
                    <div class="row justify-content-center">
                        <h2 class="m-0 font-weight-bold text-primary text-center"><i class="fas fa-info-circle"></i>
                            ~DETAIL TRANSAKSI~</h2>
                    </div>
                </div>
                <div class="card-body bg-info">
                    <div class="row justify-content-around">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="" class="text-white">ID Transaksi</label>
                                <input type="text" value="{{ $transaksi->id }}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($transaksi->detail as $detailTransaksi)
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="" class="badge badge-pill badge-info">ID Paket</label>
                            <input type="text" value="{{ $detailTransaksi->paket->id }}" name="id_paket" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="" class="badge badge-pill badge-primary">QTY</label>
                            <input type="text" value="{{ $detailTransaksi->qty }}" name="qty" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label for="" class="badge badge-pill badge-success">Keterangan</label>
                            <textarea type="text" name="keterangan" class="form-control" readonly>{{ $detailTransaksi->keterangan }}</textarea>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</body>
</html>

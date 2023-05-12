<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halaman Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url ('assets/assetss/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ url ('assets/assetss/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>

    <div class="container">
        @if(session()->exists('alert'))
            <div class="alert alert-{{ session()->get('alert') ['bg'] }} alert-dismissible fade show"
                role="alert">
                {{ session()->get('alert') ['message'] }}

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col-lg-6 text-center d-none d-lg-block">
                                <img src="{{ url('assets/assetss/img/background.jpg') }}" alt="" width="450" height="563">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img style="width: 300px; height:150px;" class="rounded"
                                        src="{{ url('assets/assetss/img/logo-2.png') }}">
                                    </div>
                                    <hr>

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang di <br> Anime Laundry</h1>
                                    </div>

                                    <form action="{{ url('/prosesLogin') }}"class="user"method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username"
                                                id="username" aria-describedby="username" placeholder="Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" id="password" placeholder="Password">
                                        </div>
                                        <div class="row">
                                        <div class="col-6">
                                                <div class="form-group">
                                                    <select name="id" class="form-control">
                                                        <option value="" selected disabled>Pilih Toko</option>
                                                        @foreach ($dataoutlet as $i )
                                                        <option value="{{ $i->id}}"> {{ $i->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="login_sebagai" id="login_sebagai"
                                                        class="form-control" required>
                                                        <option selected disabled>Masuk Sebagai</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="kasir">Kasir</option>
                                                        <option value="owner">Owner</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="login">
                                            LOGIN
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ url('assets/assetss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('assets/assetss/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ url('assets/assetss/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ url('assets/assetss/js/sb-admin-2.min.js') }}"></script>

</body>

</html>

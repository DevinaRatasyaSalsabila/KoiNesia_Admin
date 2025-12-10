<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Azza Koi Farm</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('template/assets/images/favicon-32x32.png') }}" type="image/png">

    <!--plugins-->
    <link href="{{ asset('template/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/plugins/metismenu/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/assets/plugins/metismenu/mm-vertical.css') }}" rel="stylesheet">

    <!--bootstrap css-->
    <link href="{{ asset('template/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">

    <!--main css-->
    <link href="{{ asset('template/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('template/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('template/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('template/sass/responsive.css') }}" rel="stylesheet">


</head>

<body>

    <div class="section-authentication-cover">
        <div class="">
            <div class="row g-0">

                <div
                    class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end">

                    <div class="mb-0 bg-transparent border-0 shadow-none card rounded-0">
                        <div class="card-body">
                            <img src="{{ asset('template/assets/images/auth/regis-buyer.png') }}"
                                class="img-fluid auth-img-cover-login" width="550" alt="">
                        </div>
                    </div>

                </div>

                <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                    <div class="m-3 mb-0 border-0 shadow-none card rounded-0">
                        <div class="card-body p-sm-5">
                            <img src="assets/images/logo1.png" class="mb-4" width="145" alt="">
                            <h2 class="text-center fw-bold">Registrasi Akun</h2>

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            @if ($errors->has('login_error'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('login_error') }}
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <p class="mb-0 text-center">Buat akun untuk melakukan transaksi di Azza Farm Koi</p>
                            <div class="separator section-padding">
                                <div class="mt-2 line"></div>
                            </div>

                            <div class="mt-4 form-body">
                                <form class="row g-3" action="{{ route('login.submit') }}" method="POST">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Nama</label>
                                        <input type="email" class="form-control" id="inputEmailAddress"
                                            placeholder="Masukkan Email" name="email">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmailAddress"
                                            placeholder="Masukkan Email" name="email">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Nomor HP</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">62</span>
                                            <input type="text" class="form-control" name="no_hp"
                                                placeholder="Masukkan No. HP" required aria-label="Username"
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Alamat</label>
                                        <div class="">
                                            <textarea class="form-control" id="keterangan" rows="4" placeholder="Alaman ini nantinya akan menjadi alamat utama untuk transaksi"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>

    <script src="{{ asset('template/assets/js/jquery.min.js') }}"></script>

    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => el.remove());
        }, 3000);

        $(document).ready(function() {
            $("#password_hide a").on('click', function(event) {
                event.preventDefault();
                if ($('#password_hide input').attr("type") == "text") {
                    $('#password_hide input').attr('type', 'password');
                    $('#password_hide i').addClass("bi-eye-slash-fill");
                    $('#password_hide i').removeClass("bi-eye-fill");
                } else if ($('#password_hide input').attr("type") == "password") {
                    $('#password_hide input').attr('type', 'text');
                    $('#password_hide i').removeClass("bi-eye-slash-fill");
                    $('#password_hide i').addClass("bi-eye-fill");
                }
            });
        });
    </script>

</body>

</html>

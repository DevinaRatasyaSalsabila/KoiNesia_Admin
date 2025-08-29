<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | KoiNesia</title>
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


    <!--authentication-->

    <div class="section-authentication-cover">
        <div class="">
            <div class="row g-0">

                <div
                    class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex border-end">

                    <div class="card rounded-0 mb-0 border-0 shadow-none bg-transparent">
                        <div class="card-body">
                            <img src="{{asset('template/assets/images/auth/login1.png')}}" class="img-fluid auth-img-cover-login"
                                width="650" alt="">
                        </div>
                    </div>

                </div>

                <div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
                    <div class="card rounded-0 m-3 mb-0 border-0 shadow-none">
                        <div class="card-body p-sm-5">
                            <img src="assets/images/logo1.png" class="mb-4" width="145" alt="">
                            <h2 class="fw-bold text-center">Login</h2>
                            <p class="mb-0 text-center">Masukkan Email dan Password</p>
                            <div class="separator section-padding">
                                <div class="line mt-2"></div>
                            </div>

                            <div class="form-body mt-4">
                                <form class="row g-3">
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="inputEmailAddress"
                                            placeholder="Masukkan Email">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Kata Sandi</label>
                                        <div class="input-group" id="password_hide">
                                            <input type="password" class="form-control" id="inputChoosePassword"
                                                value="12345678" placeholder="Masukkan Kata Sandi">
                                            <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                    class="bi bi-eye-slash-fill"></i></a>
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

    <!--authentication-->

    <!--plugins-->
    <script src="{{asset('template/assets/js/jquery.min.js')}}"></script>

    <script>
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

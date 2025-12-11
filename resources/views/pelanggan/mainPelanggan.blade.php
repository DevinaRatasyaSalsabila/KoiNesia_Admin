<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Jthemes" />
    <meta name="description" content="Testo - Pizza and Fast Food Landing Page Template" />
    <meta name="keywords"
        content="Jthemes, Food, Fast Food, Restaurant, Pizzeria, Restaurant Menu, Pizza, Burger, Sushi, Steak, Grill, Snack">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SITE TITLE -->
    <title>Azza Koi Farm</title>

    <!-- FAVICON AND TOUCH ICONS -->
    <link rel="shortcut icon" href="{{ asset('files/images/logo.png') }}}" type="image/x-icon">
    <link rel="icon" href="{{ asset('files/images/logo.png') }}}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('files/images/logo.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('files/images/logo.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('files/images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('files/images/logo.png') }}">
    <link rel="icon" href="{{ asset('files/images/logo.png') }}" type="image/x-icon">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="{{ asset('files/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- FONT ICONS -->
    <link href="https://use.fontawesome.com/releases/v5.11.0/css/all.css" rel="stylesheet" crossorigin="anonymous">
    <link href="{{ asset('files/css/flaticon.css') }}" rel="stylesheet">

    <!-- PLUGINS STYLESHEET -->
    <link href="{{ asset('files/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('files/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('files/css/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('files/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('files/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('files/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">

    <!-- TEMPLATE CSS -->
    <link href="{{ asset('files/css/style.css') }}" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- RESPONSIVE CSS -->
    <link href="{{ asset('files/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* efek shake */
        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            20%,
            60% {
                transform: translateX(-4px);
            }

            40%,
            80% {
                transform: translateX(4px);
            }
        }

        .shake {
            animation: shake 0.5s;
        }

        /* FIXED CART ICON MOBILE */
        #cart-icon-fixed {
            display: none;
            /* default hidden desktop */
        }

        @media (max-width: 768px) {
            #cart-icon-fixed {
                display: block;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                right: 55px;
                /* adjust biar ga nutup hamburger */
                z-index: 1050;
            }
        }

        @media (max-width: 360px) {
            #cart-icon-fixed {
                right: 45px;
            }
        }
    </style>
</head>

<body>

    <!-- PRELOADER SPINNER
  ============================================= -->
    <div id="loader-wrapper">
        <div id="loader">
            <div class="cssload-spinner">
                <div class="cssload-ball cssload-ball-1"></div>
                <div class="cssload-ball cssload-ball-2"></div>
                <div class="cssload-ball cssload-ball-3"></div>
                <div class="cssload-ball cssload-ball-4"></div>
            </div>
        </div>
    </div>

    {{-- <!-- HEADER-1
  ============================================= -->
    <header id="header-1" class="header navik-header header-shadow center-menu-1 header-transparent">
        <div class="container">


            <!-- NAVIGATION MENU -->
            <div class="navik-header-container">


                <!-- CALL BUTTON -->
                <div class="callusbtn"><a href="tel:0859348539"><i class="fas fa-phone"></i></a></div>


                <!-- LOGO IMAGE -->
                <div class="logo" data-mobile-logo="{{ asset('files/images/logo.png') }}"
                    data-sticky-logo="{{ asset('files/images/logo-3.png') }}">
                    <a href="#hero-9">
                        <img src="{{ asset('files/images/logo.png') }}" alt="header-logo" /></a>
                </div>


                <!-- BURGER MENU -->
                <div class="burger-menu">
                    <div class="line-menu line-half first-line"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu line-half last-line"></div>
                </div>


                <!-- MAIN MENU -->
                <nav class="navik-menu menu-caret navik-meat">
                    <ul class="top-list">

                        <!-- DROPDOWN MENU -->
                        <li>
                            <a href="#">Beranda</a>
                        </li>

                        <!-- Tentang Kami -->
                        <li class="mega-menu">
                            <a href="#">Tentang Kami</a>
                        </li> <!-- END MEGA MENU -->

                    </ul>
                    <ul>

                        <!-- DROPDOWN MENU -->
                        <li>
                            <a href="#">Produk</a>
                        </li>

                        <!-- DROPDOWN MENU -->
                        <li>
                            <a href="#">Kontak</a>
                        </li>


                    </ul>
                </nav> <!-- END MAIN MENU -->


            </div> <!-- END NAVIGATION MENU -->


        </div> <!-- End container -->
    </header> <!-- END HEADER-1 --> --}}

    <!-- HEADER-3
  ============================================= -->
    <header id="header-3" class="header navik-header header-transparent header-shadow">
        <div class="container">
            <!-- NAVIGATION MENU -->
            <div class="navik-header-container">
                <!-- CALL BUTTON -->
                <div class="callusbtn">
                    <a href="tel:0859348539"><i class="fas fa-phone"></i></a>
                </div>

                <!-- LOGO IMAGE -->
                <div class="logo" data-mobile-logo="{{ asset('files/images/logo.png') }}"
                    data-sticky-logo="{{ asset('files/images/logo.png') }}">
                    <a href="#hero-3">
                        <img src="{{ asset('files/images/logo.png') }}" alt="header-logo" />
                    </a>
                </div>

                <!-- BURGER MENU -->
                <div class="burger-menu">
                    <div class="line-menu line-half first-line"></div>
                    <div class="line-menu"></div>
                    <div class="line-menu line-half last-line"></div>
                </div>
                <div id="cart-icon-fixed" class="basket-ico ico-30">
                    <a href="{{ route('keranjang') }}">
                        <span class="ico-holder">
                            <span class="flaticon-shopping-bag"></span>
                            <em class="roundpoint" id="cart-count-fixed">0</em>
                        </span>
                    </a>
                </div>
                <!-- MAIN MENU (tambahin scrollspy) -->
                <nav class="navik-menu menu-caret navik-yellow">
                    <ul class="top-list">
                        <li>
                            <a href="{{ route('dashboard.pelanggan') }}">Beranda</a>
                        </li>

                        <li>
                            <a class="nav-link"
                                @if (Request::routeIs('dashboard.pelanggan')) href="#tentangKami" @else href="{{ route('dashboard.pelanggan') }}#tentangKami" @endif>Tentang
                                Kami</a>
                        </li>

                        <li>
                            <a class="nav-link"
                                @if (Request::routeIs('dashboard.pelanggan')) href="#produk" @else href="{{ route('dashboard.pelanggan') }}#produk" @endif>Produk</a>
                        </li>
                        <li>
                            <a class="nav-link"
                                @if (Request::routeIs('dashboard.pelanggan')) href="#kontak" @else href="{{ route('dashboard.pelanggan') }}#kontak" @endif>Kontak</a>
                        </li>

                        <!-- HEADER BUTTON  -->
                        <li class="nav-btn yellow-color">
                              @if (Auth::guard('pembeli')->check())
                                {{ Auth::guard('pembeli')->user()->nama_pembeli }}
                            @else
                                <a href="{{ route('registrasi.buyer') }}">Login</a>
                            @endif
                        </li>
                        <li class="basket-ico ico-30" id="cart-icon">
                            <a href="{{ route('keranjang') }}">
                                <span class="ico-holder">
                                    <span class="flaticon-shopping-bag"></span>
                                    <em class="roundpoint" id="cart-count">0</em>
                                </span>
                            </a>
                        </li>

                        <div id="cart-dropdown"
                            style="display:none; position:absolute; right:0; background:#fff; border:1px solid #ccc; padding:10px; width:250px; z-index:999;">
                            <h6>Keranjang</h6>
                            <ul id="cart-list">
                                <li>Keranjang masih kosong</li>
                            </ul>
                        </div>
                        </li>

                    </ul>
                </nav>
                <!-- END MAIN MENU -->
            </div>
            <!-- END NAVIGATION MENU -->
        </div>
        <!-- End container -->
    </header>
    {{--
    <!-- FIXED CART ICON MOBILE -->
    <div id="cart-icon-fixed" class="basket-ico ico-30">
        <a href="{{ route('keranjang') }}">
            <span class="ico-holder">
                <span class="flaticon-shopping-bag"></span>
                <em class="roundpoint" id="cart-count-fixed">0</em>
            </span>
        </a>
    </div> --}}

    <!-- END HEADER-3 -->

    <!-- PAGE CONTENT
  ============================================= -->
    <div id="page" class="page">

        @yield('content')

        <!-- HERO-9
   ============================================= -->

        <!-- FOOTER-1
   ============================================= -->
        <footer id="footer-1" class="footer division">
            <div class="container">
                <div class="row">


                    <!-- FOOTER INFO -->
                    <div class="col-md-5 col-lg-4 col-xl-4">
                        <div class="footer-info">

                            <!-- Footer Logo -->
                            <div class="footer-logo">
                                <img src="{{ asset('files/images/logo.png') }}" alt="footer-logo" />
                            </div>

                            <!-- Footer Copyright -->
                            <p>&copy; 2025. All Rights Reserved codewave</p>

                        </div>
                    </div>


                    <!-- FOOTER CONTACTS -->
                    <div class="col-md-7 col-lg-4 col-xl-5">
                        <div class="footer-contacts">

                            {{-- <!-- Address -->
                            <p class="mt-10 p-xl">Los Angeles,</p> --}}
                            <p class="p-xl">Lingkungan Klemunan, Klemunan, Kec. Wlingi, Kabupaten
                                Blitar, Jawa Timur
                                66184</p>

                            {{-- <!-- Contacts -->
                            <p class="p-lg foo-email">Email: <a
                                    href="mailto:yourdomain@mail.com">hello@yourdomain.com</a></p> --}}
                            <p class="p-lg">Telepon: <span class="yellow-color"><a
                                        href="tel:0895622273292">0895622273292</a></span></p>

                        </div>
                    </div>


                    <!-- FOOTER INSTAGRAM -->
                    <div class="col-md-12 col-lg-4 col-xl-3">
                        <div class="footer-img">
                            <!-- Images -->
                            <ul class="clearfix text-center"
                                style="display:flex; flex-wrap:wrap; justify-content:center; list-style:none; padding:15px; margin:0;">

                                <li style="flex:0 0 33.33%; text-align:center; margin-bottom:15px;">
                                    <a href="https://www.youtube.com/redirect?event=channel_description&redir_token=QUFFLUhqbGNOUnN3WFpqaExYQVg2aHpoY29BX3p1d2p2d3xBQ3Jtc0ttOXBxcGdUUEhLb2xhRWJhazJDMFJBd1ViQ0p4d2xSRjExSHNjdnBWWkpIUVJhWVZnSi1xWVhiZkFzNG9QN2tKS0h0b1JLN082d0dkb21RZy1Vd1FRejQzd2drSkFXMWNkWC03RDFKZ2hsdVAwWURYcw&q=https%3A%2F%2Fwww.instagram.com%2Freel%2FCwVHAC0BVju%2F%3Figshid%3DMzRlODBiNWFlZA%3D%3D"
                                        target="_blank">
                                        <img src="{{ asset('files/images/footer-ig.png') }}" alt="Instagram"
                                            width="35" height="35">
                                    </a>
                                </li>
                                <li style="flex:0 0 33.33%; text-align:center;">
                                    <a href="https://wa.me/62895622273292" target="_blank">
                                        <img src="{{ asset('files/images/footer-wa.png') }}" alt="WhatsApp"
                                            width="35" height="35">
                                    </a>
                                </li>
                                <li style="flex:0 0 33.33%; text-align:center; margin-bottom:15px;">
                                    <a href="#" target="_blank">
                                        <img src="{{ asset('files/images/footer-tele.png') }}" alt="Telegram"
                                            width="35" height="35">
                                    </a>
                                </li>
                                <li style="flex:0 0 33.33%; text-align:center;">
                                    <a href="https://www.youtube.com/@AzzaKoifarms1" target="_blank">
                                        <img src="{{ asset('files/images/footer-youtube.png') }}" alt="YouTube"
                                            width="35" height="35">
                                    </a>
                                </li>
                                <li style="flex:0 0 33.33%; text-align:center;">
                                    <a href="https://www.facebook.com/share/14PaBkJmQYe/" target="_blank">
                                        <img src="{{ asset('files/images/footer-facebook.png') }}" alt="Facebook"
                                            width="35" height="35">
                                    </a>
                                </li>
                                <li style="flex:0 0 33.33%; text-align:center; margin-bottom:15px;">
                                    <a href="#" target="_blank">
                                        <img src="{{ asset('files/images/footer-email.png') }}" alt="Email"
                                            width="35" height="35">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div> <!-- END FOOTER IMAGES -->


                </div> <!-- End row -->
            </div> <!-- End container -->
        </footer> <!-- END FOOTER-1 -->
    </div> <!-- END PAGE CONTENT -->

    <!-- EXTERNAL SCRIPTS
        ============================================= -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('files/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('files/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('files/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('files/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('files/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('files/js/jquery.scrollto.js') }}"></script>
    <script src="{{ asset('files/js/menu.js') }}"></script>
    <script src="{{ asset('files/js/materialize.js') }}"></script>
    <script src="{{ asset('files/js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('files/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('files/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('files/js/contact-form.js') }}"></script>
    <script src="{{ asset('files/js/comment-form.js') }}"></script>
    <script src="{{ asset('files/js/booking-form.js') }}"></script>
    <script src="{{ asset('files/js/jquery.datetimepicker.full.js') }}"></script>
    <script src="{{ asset('files/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('files/js/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Custom Script -->
    <script src="{{ asset('files/js/custom.js') }}"></script>

    @stack('script')

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!-- [if lt IE 9]>
   <script src="js/html5shiv.js" type="text/javascript"></script>
   <script src="js/respond.min.js" type="text/javascript"></script>
  <![endif] -->

    <!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->
    <!--
  <script>
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-XXXXX-X']);
      _gaq.push(['_trackPageview']);

      (function() {
          var ga = document.createElement('script');
          ga.type = 'text/javascript';
          ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
              '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(ga, s);
      })();
  </script>
  -->



</body>



</html>

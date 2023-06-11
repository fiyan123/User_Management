<!DOCTYPE HTML>
<html>

<head>
    <title>Article Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
    <!-- Ion Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.css') }}">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="{{ asset('frontend/fonts/flaticon/font/flaticon.css') }}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

</head>

<body>

    <div class="colorlib-loader"></div>

    <div id="page">

        @include('component_frontend.navbar')

        @include('component_frontend.slide')

        <div class="colorlib-intro">

            <div class="colorlib-product">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 offset-sm-2 text-center colorlib-heading">
                            <h2>Article New</h2>
                        </div>
                    </div>
                    <div class="row row-pb-md">
                        @foreach ( $data as $item )
                        <div class="col-lg-6 mb-4 text-center">
                            <div class="product-entry border">
                                <a href="#" class="prod-img">
                                    <img src="{{ $item->image() }}" class="img-fluid" alt="Deskripsi Gambar">
                                </a>
                                <div class="desc">
                                    <h2><a href="#">{{ $item->judul }}</a></h2>
                                    <span class="price">{{ $item->isi }}</span>
                                    <span class="mt-5">{{ $item->pembuat }}</span>
                                    <div style="text-align: right;">{{ date("d-m-Y", strtotime($item->tanggal_dibuat))
                                        }}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="w-100"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p><a href="#" class="btn btn-primary btn-lg">Shop All Products</a></p>
                        </div>
                    </div>
                </div>
            </div>

            @include('component_frontend.logo')

            @include('component_frontend.footer')

        </div>

        <div class="gototop js-top">
            <a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <!-- popper -->
        <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
        <!-- bootstrap 4.1 -->
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <!-- jQuery easing -->
        <script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
        <!-- Waypoints -->
        <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
        <!-- Flexslider -->
        <script src="{{ asset('frontend/js/jquery.flexslider-min.js') }}"></script>
        <!-- Owl carousel -->
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <!-- Magnific Popup -->
        <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/magnific-popup-options.js') }}"></script>
        <!-- Date Picker -->
        <script src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
        <!-- Stellar Parallax -->
        <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
        <!-- Main -->
        <script src="{{ asset('frontend/js/main.js') }}"></script>

</body>

</html>
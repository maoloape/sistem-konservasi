<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $tittle }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/assets_home/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/assets_home/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/assets_home/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/assets_home/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/assets_home/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/assets_home/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css" />

    <!-- Make sure you put this AFTER leaflet.js, when using with leaflet -->
    <script src="https://unpkg.com/leaflet-geosearch@latest/dist/bundle.min.js"></script>

    <style>
        #map_location {
            height: 500px;
            width: 100%;
            overflow: hidden;
        }

        #map_location_detail {
            height: 400px;
            width: 100%;
            overflow: hidden;
        }

        .navbar.bg-primary-transparent {
            background-color: rgba(70, 51, 23, 0.6); /* Adjust the color and transparency */
        }

        .navbar-brand img {
            max-height: 50px; /* Adjust as needed */
            height: auto;
            width: auto;
        }
        .navbar {
            padding: 0.5rem 1rem;
        }
        .navbar-nav .nav-link {
            padding: 0.5rem 1rem;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-primary-transparent navbar-light sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="/assets_home/img/logo.png" alt=""> <h2 class="m-0 text-white">Sistem Informasi Geografis</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
            </div>
            <a href="/" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Home<i
                    class="fa fa-home ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    @yield('content')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Peta Lokasi Bangunan KTA</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-0 back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets_home/lib/wow/wow.min.js"></script>
    <script src="/assets_home/lib/easing/easing.min.js"></script>
    <script src="/assets_home/lib/waypoints/waypoints.min.js"></script>
    <script src="/assets_home/lib/counterup/counterup.min.js"></script>
    <script src="/assets_home/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/assets_home/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="/assets_home/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="/assets_home/js/main.js"></script>
    @yield('js')
</body>

</html>

@extends('layout.utama')
@section('content')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="section-title text-center">
                <h1 class="display-5 mb-5">Our Services</h1>
            </div>
            <div id="map_location">
            </div>
        </div>
        <!-- Service End -->




        <!-- About Start -->
        <div id="about_us" class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
            <div class="container about px-lg-0">
                <div class="row g-0 mx-lg-0">
                    <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img class="position-absolute img-fluid w-100 h-100" src="/assets_home/img/curug.jpg"
                                style="object-fit: cover;" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                        <div class="p-lg-5 pe-lg-0">
                            <div class="section-title text-start">
                                <h1 class="display-5 mb-4">About Us</h1>
                            </div>
                            <p class="mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam
                                amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo erat
                                amet</p>
                            <div class="row g-4 mb-4 pb-2">
                                <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white"
                                            style="width: 60px; height: 60px;">
                                            <i class="fa fa-check fa-2x text-primary"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h2 class="text-primary mb-1" data-toggle="counter-up">
                                                {{ $data_konservasi->where('create_in', 'in')->count() }}</h2>
                                            <p class="fw-medium mb-0">Wilayah Konservasi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
    @endsection

    @section('js')
        <script>
            // you want to get it of the window global
            const providerOSM = new GeoSearch.OpenStreetMapProvider();

            //leaflet map
            const leafletMap = L.map('map_location', {
                fullscreenControl: true,
                // OR
                fullscreenControl: {
                    pseudoFullscreen: false // if true, fullscreen to page width and height
                },
                minZoom: 2
            }).setView([0, 0], 2);

            const listCoords = {!! json_encode($data_konservasi) !!};

            for (const {
                    bt,
                    ls,
                    create_in
                }
                of listCoords) {
                L.marker({
                    lat: bt,
                    lng: ls
                }).bindPopup(`<h3>${create_in}</h3><p align="center"><a href="#" class="link_detail btn btn-primary">Lihat Detail</a>`
                ).addTo(leafletMap);
            }

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap);
        </script>
    @endsection

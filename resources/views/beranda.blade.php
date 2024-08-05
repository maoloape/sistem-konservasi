@extends('layout.utama')
@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="/assets_home/img/cover.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(53, 53, 53, .7);">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 text-center">
                                <h5 class="text-white text-uppercase mb-3 animated slideInDown">Sistem Informasi Geografis Wisata
                                </h5>
                                <h1 class="display-3 text-white animated slideInDown mb-4">Bangunan KTA DAS Cidanau
                                </h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Sistem informasi ini merupakan aplikasi pemetaan geografis bangunan Konservasi Tanah dan Air di wilayah DAS Cidanau.
                                    Aplikasi ini memuat informasi singkat dan lokasi dari bangunan KTA tersebut.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center">
                <h1 class="display-5 mb-5">Peta Lokasi Bangunan KTA</h1>
            </div>
            <select id="kabupatenFilter">
                <option value="">Pilih Kabupaten</option>
                @php
                    $uniqueKabupaten = [];
                    $uniqueKecamatan = [];
                    $uniqueDesa = [];
                    foreach ($data_konservasi as $item) {
                        if (!in_array($item->kabupaten, $uniqueKabupaten)) {
                            $uniqueKabupaten[] = $item->kabupaten;
                        }
                        if (!in_array($item->kecamatan, $uniqueKecamatan)) {
                            $uniqueKecamatan[] = $item->kecamatan;
                        }
                        if (!in_array($item->desa, $uniqueDesa)) {
                            $uniqueDesa[] = $item->desa;
                        }
                    }
                @endphp
                @foreach ($uniqueKabupaten as $kabupaten)
                    <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                @endforeach
            </select>

            <select id="kecamatanFilter">
                <option value="">Pilih Kecamatan</option>
                @foreach ($uniqueKecamatan as $kecamatan)
                    <option value="{{ $kecamatan }}">{{ $kecamatan }}</option>
                @endforeach
            </select>

            <select id="desaFilter">
                <option value="">Pilih Desa</option>
                @foreach ($uniqueDesa as $desa)
                    <option value="{{ $desa }}">{{ $desa }}</option>
                @endforeach
            </select>
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
                            <div class="text-start">
                                <h1 class="display-5 mb-4">Bangunan KTA di DAS Cidanau</h1>
                            </div>
                            <p class="mb-4 pb-2">DAS Cidanau merupakan DAS penting dalam konteks pembangunan ekonomi di kawasan Kota Cilegon serta sebagian wilayah Serang Bagian Barat. Kota sentra industri dengan beberapa diantaranya secara nasional merupakan industri strategis, seperti baja, kimia hulu dan energi listrik. Bangunan KTA di DAS Cidanau dirancang untuk menjaga kelestarian lingkungan dan mendukung ketersediaan air baku.</p>
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

        const markers = [];

        let bounds = L.latLngBounds();

        for (const {
                bt,
                ls,
                id,
                das,
                kabupaten,
                kecamatan,
                desa
            } of listCoords) {
            const marker = L.marker({
                lat: bt,
                lng: ls
            }).bindPopup(`<h3>${das}</h3><p align="center"><a href="/detail/${id}" class="link_detail btn btn-primary">Lihat Detail</a>`
            ).addTo(leafletMap);

            marker.kabupaten = kabupaten;
            marker.kecamatan = kecamatan;
            marker.desa = desa;
            markers.push(marker);

            bounds.extend([bt, ls]);
        }

        leafletMap.fitBounds(bounds);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap);

        // Adding search functionality
        const search = new GeoSearch.GeoSearchControl({
            provider: providerOSM,
            style: 'icon',
            searchLabel: 'Search',
        });

        leafletMap.addControl(search);

        // Filter functionality
        function filterMarkers() {
            const selectedKabupaten = document.getElementById('kabupatenFilter').value;
            const selectedKecamatan = document.getElementById('kecamatanFilter').value;
            const selectedDesa = document.getElementById('desaFilter').value;

            markers.forEach(marker => {
                if ((selectedKabupaten === "" || marker.kabupaten === selectedKabupaten) &&
                    (selectedKecamatan === "" || marker.kecamatan === selectedKecamatan) &&
                    (selectedDesa === "" || marker.desa === selectedDesa)) {
                    leafletMap.addLayer(marker);
                } else {
                    leafletMap.removeLayer(marker);
                }
            });
        }

        document.getElementById('kabupatenFilter').addEventListener('change', filterMarkers);
        document.getElementById('kecamatanFilter').addEventListener('change', filterMarkers);
        document.getElementById('desaFilter').addEventListener('change', filterMarkers);
    </script>

    @endsection

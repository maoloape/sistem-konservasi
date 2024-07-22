@extends('layout.utama')

@section('content')
<div class="container overflow-hidden my-5 px-lg-0">
    <div class="row">
        <div class="col-md-6">
            <div class="display-5 mb-5">
                <h1>Informasi Wisata</h1>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p><b>Detail</b></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>Daerah</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->das }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>Alamat</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->das }}, {{ $data1->kabupaten }}, {{ $data1->kecamatan }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>Deskripsi</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->keterangan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="display-5 mb-5">
                <h1>Lokasi</h1>
            </div>
            <div id="map_location" class="position-relative h-400"></div>
        </div>
    </div>
</div>

<!-- Projects Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center">
            <h1 class="display-5 mb-5">Galeri</h1>
        </div>
        <div class="row g-4 portfolio-container">
            @php
            $filename = $images;
        @endphp
        @if ($filename)
            @foreach ($filename as $img)
                <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                    <div class="rounded overflow-hidden">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{ asset('uploads/' . $img->filename) }}" alt="">
                            <div class="portfolio-overlay">
                                <a class="btn btn-square btn-outline-light mx-1" href="{{ asset('uploads/' . $img->filename) }}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
    </div>
</div>
<!-- Projects End -->

@endsection

@section('js')
<script>
    const providerOSM = new GeoSearch.OpenStreetMapProvider();

    const leafletMap = L.map('map_location', {
        fullscreenControl: true,
        minZoom: 2
    }).setView([{{ $data1->bt }}, {{ $data1->ls }}], 15);

    L.marker([{{ $data1->bt }}, {{ $data1->ls }}]).addTo(leafletMap);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);
</script>
@endsection

@extends('layout.utama')

@section('content')
<div class="container overflow-hidden my-5 px-lg-0">
    <div class="display-5 mb-5">
        <h1>{{ $data->das }}</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p>Desa {{ $data->das }}, Kabupaten {{ $data->kabupaten }}, Kecamatan {{ $data->kecamatan }}</p>
            <div>
                <p style="text-align: justify;"><strong>Keterangan</strong></p>
                <p style="text-align: justify;">{{ $data->keterangan }}</p>
            </div>
        </div>
        <div class="col-md-6">
            <div id="map_location" class="position-relative h-400"></div>
        </div>
    </div>
</div>

<!-- Projects Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center">
            <h1 class="display-5 mb-5">Galery</h1>
        </div>
        <div class="row g-4 portfolio-container">
            <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                <div class="rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('uploads/' . $data->dokumentasi) }}" alt="">
                        <div class="portfolio-overlay">
                            <a class="btn btn-square btn-outline-light mx-1" href="{{ asset('uploads/' . $data->dokumentasi) }}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
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
    }).setView([{{ $data->bt }}, {{ $data->ls }}], 15);

    L.marker([{{ $data->bt }}, {{ $data->ls }}]).addTo(leafletMap);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);
</script>
@endsection

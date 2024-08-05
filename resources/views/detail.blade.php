@extends('layout.utama')

@section('content')

<style>

    .short-hr {
        width: 30%; /* Adjust this value to make the line shorter or longer */
        margin-left: 0; /* Atur margin kiri menjadi 0 */
        border: 1px solid #000; /* Adjust the border properties as needed */
    }

</style>

<div class="container overflow-hidden my-5 px-lg-0">
    <div class="row">
        <div class="col-md-6">
            <div class="display-5 mb-5">
                <h1>Informasi Wisata</h1>
                <hr class="short-hr">
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p style="font-size: 24px"><b>Detail</b></p>
                </div>
                <hr>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>DAS</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->das }}</p>
                </div>
                <hr>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>Sub DAS</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->sub_das }}</p>
                </div>
                <hr>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>Alamat</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->desa }}, {{ $data1->kecamatan }}, {{ $data1->kabupaten }}, Banten</p>
                </div>
                <hr>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>Blok</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->blok }}</p>
                </div>
                <hr>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>Jenis Batu</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->jenis_batu }}</p>
                </div>
                <hr>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p>Volume</p>
                </div>
                <div class="col-md-8">
                    <p class="fw-bold">{{ $data1->volume }}</p>
                </div>
                <hr>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <p style="font-size: 24px"><b>Dokumentasi</b></p>
                </div>
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
        <div class="col-md-6">
            <div class="display-5 mb-5">
                <h1>Lokasi</h1>
            </div>
            <div id="map_location_detail" class="position-relative h-240"></div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    const providerOSM = new GeoSearch.OpenStreetMapProvider();

    const leafletMap = L.map('map_location_detail', {
        fullscreenControl: true,
        minZoom: 2
    }).setView([{{ $data1->bt }}, {{ $data1->ls }}], 15);

    L.marker([{{ $data1->bt }}, {{ $data1->ls }}]).addTo(leafletMap);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leafletMap);
</script>
@endsection

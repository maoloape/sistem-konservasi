@extends('layout.utama')
@section('content')


    <div class="container overflow-hidden my-5 px-lg-0">
        <div class="">
        <h1>{{ $data_konservasi->where('das', 'Test')}}</h1>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p>Lokasi: Jl. Batukaru, Denpasar Selatan,Wongaya Gede,Penebel,Kabupaten Tabanan, Bali</p>
            <div>
                <p style="text-align: justify;"><strong>**Sejarah Pura**</strong></p>
                <p style="text-align: justify;">.</p>
                <p style="text-align: justify;"><strong>**Piodalan**</strong></p>
                <p style="text-align: justify;">Upacara piodalan di pura Batukaru&nbsp;jatuh setiap 210 hari sekali yaitu pada setiap Kamis Wuku Dungulan</p>
                <p style="text-align: justify;"><strong>**Denah Pura**</strong></p>
                <p style="text-align: justify;">&nbsp;</p>
            </div>
        </div>
        <div class="col-md-6">
            <div id="map_location" class="position-relative h-100">

            </div>
        </div>
        <div class="col-md-6">
            <h3>Galeri</h3>
        </div>
    </div>



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

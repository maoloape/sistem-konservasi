@extends('layout.layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row md-3">
                                <h4 class="card-title">Data Konservasi</h4>
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                                    data-target="#modalCreate">
                                    <i class="fa fa-plus"></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>DAS</th>
                                        <th>SUB DAS</th>
                                        <th>Kabupaten</th>
                                        <th>Kecamatan</th>
                                        <th>Desa</th>
                                        <th>Blok</th>
                                        <th>BT</th>
                                        <th>LS</th>
                                        <th>Jenis Batu</th>
                                        <th>Dokumentasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data_konservasi as $row)
                                        <tr>
                                            <td>{{ $no++ }} </td>
                                            <td>{{ $row->das }}</td>
                                            <td>{{ $row->sub_das }}</td>
                                            <td>{{ $row->kabupaten }}</td>
                                            <td>{{ $row->kecamatan }}</td>
                                            <td>{{ $row->desa }}</td>
                                            <td>{{ $row->blok }}</td>
                                            <td>{{ $row->bt }}</td>
                                            <td>{{ $row->ls }}</td>
                                            <td>{{ $row->jenis_batu }}</td>
                                            <td><img src="{{ asset('uploads/' . $row->dokumentasi) }}" alt=""
                                                    width="80px"></td>
                                            <td>
                                                <a href="#modalEdit{{ $row->id }}" data-toggle="modal"
                                                    class="btn btn-xs btn-primary" data-id="{{ $row->id }}"
                                                    data-lat="{{ $row->bt }}" data-long="{{ $row->ls }}"><i
                                                        class="fa fa-edit"></i> Edit</a>
                                                <a href="#modalHapus{{ $row->id }}" data-toggle="modal"
                                                    class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Input Data</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/konservasi-data/store" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Das</label>
                            <input type="text" class="form-control" name="das" placeholde="Das ..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Sub Das</label>
                            <input type="text" class="form-control" name="sub_das" placeholde="Sub Das ..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Kabupaten</label>
                            <input type="text" class="form-control" name="kabupaten" placeholde="Kabupaten ..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" name="kecamatan" placeholde="Kecamatan ..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Desa</label>
                            <input type="text" class="form-control" name="desa" placeholde="Desa ..." required>
                        </div>
                        <div class="form-group">
                            <label for="">Blok</label>
                            <input type="text" class="form-control" name="blok" placeholde="Blok ..." required>
                        </div>
                        <label for="">Pilih Lokasi</label>
                        <div id="map" class="form-group">
                        </div>
                        <div class="form-group">
                            <label for="">BT</label>
                            <input type="text" class="form-control" id="latitude" name="bt" placeholde="BT ..."
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">LS</label>
                            <input type="text" class="form-control" id="longitude" name="ls" placeholde="LS ..."
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Batu</label>
                            <input type="text" class="form-control" name="jenis_batu" placeholde="Jenis Batu ..."
                                required>
                        </div>
                        <div class="form-group">
                            <label for="">Dokumentasi</label>
                            <input type="file" name="dokumentasi" accept=".png, .jpg, .jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>
                            Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($data_konservasi as $d)
        <div class="modal modal-edit fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="/konservasi-data/update/{{ $d->id }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Das</label>
                                <input type="text" value="{{ $d->das }}" class="form-control" name="das"
                                    placeholde="Das ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Sub Das</label>
                                <input type="text" value="{{ $d->sub_das }}" class="form-control" name="sub_das"
                                    placeholde="Sub Das ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Kabupaten</label>
                                <input type="text" value="{{ $d->kabupaten }}" class="form-control" name="kabupaten"
                                    placeholde="Kabupaten ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Kecamatan</label>
                                <input type="text" value="{{ $d->kecamatan }}" class="form-control" name="kecamatan"
                                    placeholde="Kecamatan ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Desa</label>
                                <input type="text" value="{{ $d->desa }}" class="form-control" name="desa"
                                    placeholde="Desa ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Blok</label>
                                <input type="text" value="{{ $d->blok }}" class="form-control" name="blok"
                                    placeholde="Blok ..." required>
                            </div>
                            <label for="">Pilih Lokasi</label>
                            <div id="map-{{ $d->id }}" class="map">

                            </div>
                            <div class="form-group">
                                <label for="">BT</label>
                                <input type="text" value="{{ $d->bt }}" class="form-control"
                                    id="lat-{{ $d->id }}" name="bt" placeholde="BT ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">LS</label>
                                <input type="text" value="{{ $d->ls }}" class="form-control"
                                    id="long-{{ $d->id }}" name="ls" placeholde="LS ..." required>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Batu</label>
                                <input type="text" value="{{ $d->jenis_batu }}" class="form-control"
                                    name="jenis_batu" placeholde="Jenis Batu" required>
                            </div>
                            <div class="form-group">
                                <label for="">Dokumentasi</label>
                                <input type="file" accept=".png, .jpg, .jpeg" class="form-control"
                                    name="dokumentasi">
                                @if ($d->dokumentasi)
                                    <img src="{{ asset('uploads/' . $d->dokumentasi) }}" alt="Current Image"
                                        width="80px">
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-undo"></i> Close</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($data_konservasi as $c)
        <div class="modal fade" id="modalHapus{{ $c->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Data Barang</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <form method="GET" action="/konservasi-data/destroy/{{ $d->id }}">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <h5>Apakah Anda Ingin Menghapus Data Ini</h5>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fa fa-undo"></i> Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('js')
    <script>
        // you want to get it of the window global
        const providerOSM = new GeoSearch.OpenStreetMapProvider();

        //leaflet map
        var leafletMap = L.map('map', {
            fullscreenControl: true,
            // OR
            fullscreenControl: {
                pseudoFullscreen: false // if true, fullscreen to page width and height
            },
            minZoom: 2
        }).setView([0, 0], 2);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap);

        let theMarker = {};

        leafletMap.on('click', function(e) {
            let latitude = e.latlng.lat.toString().substring(0, 15);
            let longitude = e.latlng.lng.toString().substring(0, 15);

            let popup = L.popup()
                .setLatLng([latitude, longitude])
                .setContent("Kordinat : " + latitude + " - " + longitude)
                .openOn(leafletMap);

            document.querySelector("#longitude").value = longitude;
            document.querySelector("#latitude").value = latitude;

            if (theMarker != undefined) {
                leafletMap.removeLayer(theMarker);
            };
            theMarker = L.marker([latitude, longitude]).addTo(leafletMap);
        });

        const search = new GeoSearch.GeoSearchControl({
            provider: providerOSM,
            style: 'icon',
            searchLabel: 'Search',
        });

        leafletMap.addControl(search);

        $('#modalCreate').on('shown.bs.modal', function() {
            setTimeout(function() {
                leafletMap.invalidateSize();
            }, 10);
        });

        const leafletMapEdit = {};

        $(".modal-edit").on("shown.bs.modal", function(e) {
            const dataId = $(e.relatedTarget).data('id');
            const lat = $(e.relatedTarget).data('lat');
            const long = $(e.relatedTarget).data('long');

            let pin = L.marker({
                lat: lat,
                lng: long
            });
            if (!(typeof leafletMapEdit[`map-${dataId}`] == "object")) {
                leafletMapEdit[`map-${dataId}`] = L.map(`map-${dataId}`, {
                    fullscreenControl: true,
                    // OR
                    fullscreenControl: {
                        pseudoFullscreen: false // if true, fullscreen to page width and height
                    },
                    minZoom: 2
                }).setView([lat, long], 2);


                leafletMapEdit[`map-${dataId}`].on('click', function(e) {
                    let latitude = e.latlng.lat.toString().substring(0, 15);
                    let longitude = e.latlng.lng.toString().substring(0, 15);

                    let popup = L.popup()
                        .setLatLng([latitude, longitude])
                        .setContent("Kordinat : " + latitude + " - " + longitude)
                        .openOn(leafletMapEdit[`map-${dataId}`]);

                    $("#lat-" + dataId).val(latitude);
                    $("#long-" + dataId).val(longitude);

                    // if (theMarker != undefined) {
                    leafletMapEdit[`map-${dataId}`].removeLayer(pin);
                    // };
                    pin = L.marker([latitude, longitude]).addTo(leafletMapEdit[`map-${dataId}`]);
                });

                const search = new GeoSearch.GeoSearchControl({
                    provider: providerOSM,
                    style: 'icon',
                    searchLabel: 'Search',
                });

                leafletMapEdit[`map-${dataId}`].addControl(search);
            } else {
                leafletMapEdit[`map-${dataId}`].setZoom(3).panTo([lat, long]);
            }

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMapEdit[`map-${dataId}`]);


            pin.addTo(leafletMapEdit[`map-${dataId}`]);

            // let theMarker = {};
            leafletMapEdit[`map-${dataId}`].invalidateSize();

        });
    </script>
@endsection

@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" rel="stylesheet" />
    <style>
        #map *+* {
            margin: 0;
        }
    </style>
@endpush

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Parkir point</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </nav>


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center align-self-center mb-3">
                <h6>Parkir Points</h6>
            </div>
            @if ($errors->any())
                {!! implode(
                    '',
                    $errors->all(
                        '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Error!</strong> :message<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button></div>',
                    ),
                ) !!}
            @endif
            <form action="{{ route('parkir-point.update', ['parkir_point' => $parkir->id]) }}" method="POST"
                x-data="{ is_fixed: {{ $parkir->is_fixed == 1 ? 'true' : 'false' }} }">
                @csrf
                @method('PUT')
                <div class="col-6 mb-3 mt-4">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="point_name" value="{{ $parkir->name }}">
                </div>
                <div class="col-6 mb-3 mt-4">
                    <label class="form-label">Price</label>
                    <input type="number" class="form-control" name="price" value="{{ $parkir->price }}">
                </div>
                <div class="form-check form-switch my-4">
                    <input type="checkbox" name="is_fixed" id="fixed_price_selector" class="form-check-input"
                        x-model="is_fixed">
                    <label class="form-check-label">Fixed Price</label>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Price Unit</label>
                    <select name="price_unit" :disabled="is_fixed" class="form-select" required>
                        <option {{ empty($parkir->unit_for_price) ? 'selected' : '' }} disabled>-- Select Price Unit
                            --
                        </option>
                        <option {{ $parkir->unit_for_price == 'minute' ? 'selected' : '' }} value="minute">Per Minute
                        </option>
                        <option {{ $parkir->unit_for_price == 'hour' ? 'selected' : '' }} value="hour">Per Hour</option>
                        <option {{ $parkir->unit_for_price == 'day' ? 'selected' : '' }} value="day">Per Day</option>
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label">Address</label>
                    <textarea rows="3" class="form-control" name="point_address">{{ $parkir->address }}</textarea>
                </div>
                <div class="row">
                    <div class="col-4 mb-3">
                        <label class="form-label">Longitude</label>
                        <input type="text" class="form-control" readonly name="longitude_id" id="longitude"
                            value="{{ $parkir->longitude }}">
                    </div>
                    <div class="col-4 mb-3">
                        <label class="form-label">latitude</label>
                        <input type="text" class="form-control" readonly name="latitude_id" id="latitude"
                            value="{{ $parkir->latitude }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span class="text-info font-weight-bold">* Click on the Map to Set location</span>
                        <div id="map" style="width:100%;height: 40vh;" class="mb-4"></div>
                    </div>
                </div>
                <a href="{{ route('parkir-point.index') }}" class="btn btn-secondary">Back</a>
                <button class="btn btn-primary" type="submit" value="update_data" name="button_active">Submit</button>
                @if ($parkir->status_active == 'active')
                    <button class="btn btn-danger" type="submit" value="non_active" name="button_active">Non -
                        Active
                    </button>
                @endif
                @if ($parkir->status_active == 'non-active')
                    <button class="btn btn-success" type="submit" value="active_data" name="button_active">Active
                    </button>
                @endif
            </form>
            <hr>
            <div class="d-flex align-items-center align-self-center mb-3">
                <h6>Jukir assignment
                    @if ($parkir->status_active == 'active')
                        <button class="btn btn-success" id="show_parkir_point_jukir">+</button>
                    @endif
                </h6>
            </div>

            {{ $dataTable->table() }}
        </div>
    </div>
    @include('trparkirpoint::modal_detail')
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/leaflet.js"></script>
@endpush

@push('custom-scripts')
    <script>
        $(function() {
            // reference: https://codepen.io/aaronpinero/pen/yQOKdY
            const modal_jukir = new bootstrap.Modal(document.getElementById('parkir_point_jukir'), {
                keyboard: false
            });

            let map;
            let pin = L.marker({
                lat: {{ $parkir->latitude }},
                lng: {{ $parkir->longitude }}
            }, {
                riseOnHover: true,
                draggable: true
            });;
            const tilesURL = 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png';
            const mapAttrib =
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, Tiles courtesy of <a href="http://hot.openstreetmap.org/" target="_blank">Humanitarian OpenStreetMap Team</a>';


            $('#jukir_select_2').select2({
                dropdownParent: $('#parkir_point_jukir'),
            });

            $('#show_parkir_point_jukir').on('click', function() {
                modal_jukir.show();
            });

            function MapCreate() {
                // create map instance
                if (!(typeof map == "object")) {
                    map = L.map('map', {
                        center: [
                            {{ $parkir->latitude }},
                            {{ $parkir->longitude }}
                        ],
                        zoom: 14
                    });
                } else {
                    map.setZoom(3).panTo([40, 0]);
                }

                // create the tile layer with correct attribution
                L.tileLayer(tilesURL, {
                    attribution: mapAttrib,
                    maxZoom: 19
                }).addTo(map);

                pin.addTo(map);


                map.on('click', function(ev) {
                    $('#latitude').val(ev.latlng.lat);
                    $('#longitude').val(ev.latlng.lng);
                    console.log(ev.latlng);
                    if (typeof pin == "object") {
                        pin.setLatLng(ev.latlng);
                    } else {
                        pin = L.marker(ev.latlng, {
                            riseOnHover: true,
                            draggable: true
                        });
                        pin.addTo(map);
                        pin.on('drag', function(ev) {
                            $('#latitude').val(ev.latlng.lat);
                            $('#longitude').val(ev.latlng.lng);
                        });
                    }
                });
            }



            MapCreate();
        })
    </script>
    {{ $dataTable->scripts() }}
@endpush

@extends('layout.layout')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                    <div class="card-body">
                        <h3 class="card-title text-white">Wilayah Konservasi</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ $data_konservasi->where('create_in', 'in')->count() }}</h2>
                            <p class="text-white mb-0">{{ now()->format('Y-m-d') }}</p>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa-light fa-location-dot"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row md-3">
                                <h4 class="card-title">Data Konservasi</h4>
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
                                            <td>{{ $row->jenis_batu }}</td>
                                            <td><img src="{{ asset('uploads/' . $row->dokumentasi) }}" alt=""
                                                    width="80px"></td>
                                            {{-- <td>
                                                @if($row->dokumentasi)
                                                    @foreach(json_decode($row->dokumentasi) as $image)
                                                        <img src="{{ asset('uploads/' . $image) }}" alt="Dokumentasi" width="50" height="50">
                                                    @endforeach
                                                @endif
                                            </td> --}}
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


@endsection

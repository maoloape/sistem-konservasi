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

@endsection

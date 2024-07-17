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
                                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
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
                                        <td>{{ $row->dokumentasi }}</td>
                                        <td>
                                            <a href="#modalEdit{{ $row->id }}" data-toggle="modal" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
                <form method="POST" action="/konservasi-data/store">
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
                        <input type="text" class="form-control" id="latitude" name="bt" placeholde="BT ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">LS</label>
                        <input type="text" class="form-control" id="longitude" name="ls" placeholde="LS ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Batu</label>
                        <input type="text" class="form-control" name="jenis_batu" placeholde="Jenis Batu" required>
                    </div>
                    <div class="form-group">
                        <label for="">Dokumentasi</label>
                        <input type="text" class="form-control" name="dokumentasi" placeholde="No. Kontrak ..." required>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
   
    @foreach ($data_konservasi as $d)
    <div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <form method="POST" action="/konservasi-data/update/{{ $d->id }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Das</label>
                        <input type="text" value="{{ $d->das }}" class="form-control" name="das" placeholde="Das ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Sub Das</label>
                        <input type="text" value="{{ $d->sub_das }}" class="form-control" name="sub_das" placeholde="Sub Das ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Kabupaten</label>
                        <input type="text" value="{{ $d->kabupaten }}" class="form-control" name="kabupaten" placeholde="Kabupaten ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <input type="text" value="{{ $d->kecamatan }}" class="form-control" name="kecamatan" placeholde="Kecamatan ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Desa</label>
                        <input type="text" value="{{ $d->desa }}" class="form-control" name="desa" placeholde="Desa ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Blok</label>
                        <input type="text" value="{{ $d->blok }}" class="form-control" name="blok" placeholde="Blok ..." required>
                    </div>
                    <label for="">Pilih Lokasi</label>
                    <div id="map" class="form-group">
                        
                    </div>
                    <div class="form-group">
                        <label for="">BT</label>
                        <input type="text" value="{{ $d->bt }}" class="form-control" id="latitude" name="bt" placeholde="BT ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">LS</label>
                        <input type="text" value="{{ $d->ls }}" class="form-control" id="longitude" name="ls" placeholde="LS ..." required>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Batu</label>
                        <input type="text" value="{{ $d->jenis_batu }}" class="form-control" name="jenis_batu" placeholde="Jenis Batu" required>
                    </div>
                    <div class="form-group">
                        <label for="">Dokumentasi</label>
                        <input type="text" value="{{ $d->dokumentasi }}" class="form-control" name="dokumentasi" placeholde="No. Kontrak ..." required>
                    </div>
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save changes</button>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

@endsection
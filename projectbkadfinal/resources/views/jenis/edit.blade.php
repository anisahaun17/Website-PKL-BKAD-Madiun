@section('title', 'Edit Jenis')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Ubah Jenis Pelayanan</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('jenis.update', request()->jenis) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-label">Kategori</label>
                                <select class="form-control" name="kategori" id="kategori">
                                    @foreach ($data['kategori'] as $resKategori)
                                        <option value="{{ $resKategori->id }}"
                                            {{ $resKategori->id == $data['jenis']->kategori_id ? 'selected' : '' }}>
                                            {{ $resKategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{ $data['jenis']->nama }}">
                                @error('nama')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Tarif</label>
                                <input type="number" class="form-control" name="tarif" id="tarif"
                                    value="{{ $data['jenis']->tarif }}">
                                @error('tarif')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info col-lg-2 col-3">Edit</button>
                            <button onclick="window.location.href='{{ route('jenis.index') }}'" class="btn btn-secondary"
                                type="button">Batal</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush

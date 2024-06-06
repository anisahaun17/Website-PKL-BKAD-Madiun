@section('title', 'Edit Penyewa')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Ubah Sewa</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('sewa.update', request()->sewa) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Kode Transaksi</label>
                                        <input type="text" class="form-control" disabled readonly
                                            value="{{ $data['sewa']->kode_transaksi }}">
                                        @error('alamat')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            value="{{ $data['sewa']->nama }}">
                                        @error('nama')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" name="telepon" id="telepon"
                                            value="{{ $data['sewa']->telepon }}">
                                        @error('telepon')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">NPWR</label>
                                        <input type="text" class="form-control" name="npwr" id="npwr"
                                            value="{{ $data['sewa']->npwr }}">
                                        @error('npwr')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">NIK</label>
                                        <input type="number" class="form-control" name="nik" id="nik"
                                            value="{{ $data['sewa']->nik }}">
                                        @error('nik')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Alamat</label>
                                        <textarea type="text" class="form-control" name="alamat" id="alamat">{{ $data['sewa']->alamat }}</textarea>
                                        @error('alamat')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Tanggal Sewa</label>
                                        <input type="date" class="form-control" name="tgl_sewa_mulai" id="tgl_sewa_mulai"
                                            value="{{ $data['sewa']->tgl_sewa_mulai }}">
                                        @error('tgl_sewa_mulai')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Lama Sewa</label>
                                        <input type="number" class="form-control" name="lama_sewa" id="lama_sewa"
                                            value="{{ $data['sewa']->lama_sewa }}">
                                        @error('lama_sewa')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info col-lg-2 col-3">Ubah</button>
                            <button onclick="window.location.href='{{ route('sewa.index') }}'" class="btn btn-secondary"
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

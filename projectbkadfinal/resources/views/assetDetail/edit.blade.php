@section('title', 'Edit Detail Asset')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Ubah Aset</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('asset-detail.update', request()->assetDetail) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-label">Panjang</label>
                                <input type="text" class="form-control" name="panjang" id="panjang"
                                    value="{{ $data['assetDetail']->panjang }}">
                                @error('panjang')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Lebar</label>
                                <input type="text" class="form-control" name="lebar" id="lebar"
                                    value="{{ $data['assetDetail']->lebar }}">
                                @error('lebar')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Jumlah Aset</label>
                                <input type="text" class="form-control" name="jumlah_asset" id="jumlah_asset"
                                    value="{{ $data['assetDetail']->jumlah_asset }}">
                                @error('jumlah_asset')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" name="asset_id" id="asset_id"
                                value="{{ $data['assetDetail']->asset_id }}">
                            <button class="btn btn-info col-lg-2 col-3">Ubah</button>
                            <button
                                onclick="window.location.href='{{ route('asset.detail', $data['assetDetail']->asset_id) }}'"
                                class="btn btn-secondary" type="button">Batal</button>
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

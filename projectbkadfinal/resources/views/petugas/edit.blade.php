@section('title', 'Edit Petugas')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Edit Petugas</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('petugas.update', request()->petugas) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{ $data['petugas']->nama }}">
                                @error('nama')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info col-lg-2 col-3">Edit</button>
                            <button onclick="window.location.href='{{ route('petugas.index') }}'" class="btn btn-secondary"
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

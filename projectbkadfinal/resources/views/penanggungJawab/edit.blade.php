@section('title', 'Edit Penanggung Jawab')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Ubah Penanggung Jawab</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pj.update', request()->penanggungJawab) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{ $data['pj']->nama }}">
                                @error('nama')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">NIP</label>
                                <input type="text" class="form-control" name="nip" id="nip"
                                    value="{{ $data['pj']->nip }}">
                                @error('nip')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Jabatan</label>
                                <select class="form-control" name="jabatan" id="jabatan">
                                    @foreach ($data['jabatan'] as $resJabatan)
                                        <option value="{{ $resJabatan->id }}"
                                            {{ $data['pj']->jabatan_id == $resJabatan->id ? 'selected' : '' }}>
                                            {{ $resJabatan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jabatan')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="Aktif" {{ $data['pj']->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="Non Aktif" {{ $data['pj']->status == 'Non Aktif' ? 'selected' : '' }}>
                                        Non-Aktif
                                    </option>
                                </select>
                                @error('status')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info col-lg-2 col-3">Edit</button>
                            <button onclick="window.location.href='{{ route('pj.index') }}'" class="btn btn-secondary"
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

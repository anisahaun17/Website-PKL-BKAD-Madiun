@section('title', 'Edit Asset')
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
                        <form action="{{ route('asset.update', request()->assets) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{ $data['asset']->nama }}">
                                @error('nama')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Lokasi</label>
                                <textarea type="text" class="form-control" name="lokasi" id="lokasi">{{ $data['asset']->lokasi }}</textarea>
                                @error('lokasi')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Kategori</label>
                                <select class="form-control" name="kategori" id="kategori">
                                    @foreach ($data['kategori'] as $resKategori)
                                        <option value="{{ $resKategori->id }}"
                                            {{ $data['asset']->jenis->kategori->id == $resKategori->id ? 'selected' : '' }}>
                                            {{ $resKategori->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Jenis</label>
                                <select class="form-control select2" name="jenis" id="jenis" style="width: 100%;">
                                </select>
                                @error('jenis')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <button class="btn btn-info col-lg-2 col-3">Edit</button>
                            <button onclick="window.location.href='{{ route('asset.index') }}'" class="btn btn-secondary"
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
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('template') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush
@push('js')
    <!-- Select2 -->
    <script src="{{ url('template') }}/plugins/select2/js/select2.full.min.js"></script>

    <script>
        function updateSelect2(filteredJenis, selectedJenisId) {
            var select2Data = filteredJenis.map(function(resJenis) {
                return {
                    id: resJenis.id,
                    text: resJenis.nama,
                    selected: resJenis.id == selectedJenisId
                };
            });

            $('.select2').empty().select2({
                theme: 'bootstrap4',
                data: select2Data
            });
        }

        function fetchJenisOptions(kategoriId, selectedJenisId) {
            var url = "{{ route('api.jenisByKategori', 'kategori_id') }}"
            $.ajax({
                url: url.replace('kategori_id', kategoriId),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    updateSelect2(data, selectedJenisId);
                },
                error: function(error) {
                    console.error('Error fetching jenis data:', error);
                }
            });
        }

        var kategori = $('#kategori').val();
        var selectedJenisId = {{ $data['asset']->jenis_id }};
        fetchJenisOptions(kategori, selectedJenisId);

        $('#kategori').change(function(e) {
            var kategori = $(this).val();
            fetchJenisOptions(kategori);
        });
    </script>
@endpush

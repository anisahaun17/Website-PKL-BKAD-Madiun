@section('title', 'Asset')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#tambahAsset">
            <i class="fas fa-plus-square"></i>
            Tambah Aset
        </button>
        <div class="modal fade" id="tambahAsset">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('asset.store') }}" method="POST">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title">Form Tambah Aset</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    value="{{ old('nama') }}">
                                @error('nama')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Lokasi</label>
                                <textarea type="text" class="form-control" name="lokasi" id="lokasi">{{ old('lokasi') }}</textarea>
                                @error('lokasi')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Kategori</label>
                                <select class="form-control" name="kategori" id="kategori">
                                    <option value="0" disabled selected>Silahkan pilih kategori</option>
                                    @foreach ($data['kategori'] as $resKategori)
                                        <option value="{{ $resKategori->id }}">
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
                                    <option value="0" disabled selected>Silahkan pilih kategori</option>
                                </select>
                                @error('jenis')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-info">Tambah</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Aset</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['asset'] as $index => $resAsset)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $resAsset->nama }}</td>
                                    <td>{{ $resAsset->lokasi }}</td>
                                    <td class="text-center">
                                        <h5><span class="badge badge-info">{{ $resAsset->jenis->kategori->nama }}</span>
                                        </h5>
                                    </td>
                                    <td>{{ $resAsset->jenis->nama }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button
                                                onclick="window.location.href='{{ route('asset.detail', $resAsset->id) }}'"
                                                type="button" class="btn btn-info btn-flat">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                onclick="window.location.href='{{ route('asset.edit', $resAsset->id) }}'"
                                                type="button" class="btn btn-warning btn-flat">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="{{ route('asset.delete', $resAsset->id) }}"
                                                class="btn btn-danger btn-flat" data-confirm-delete="true">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('template') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ url('template') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('template') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('template') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('template') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@push('js')
    <!-- Select2 -->
    <script src="{{ url('template') }}/plugins/select2/js/select2.full.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ url('template') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "paging": true,
                "autoWidth": false,
            })
        });


        $('#kategori').change(function(e) {
            var kategori = $(this).val();
            var url = "{{ route('api.jenisByKategori', 'kategori_id') }}"

            $.ajax({
                url: url.replace('kategori_id', kategori),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    var select2Data = data.map(function(resJenis) {
                        return {
                            id: resJenis.id,
                            text: resJenis.nama
                        };
                    });

                    $('#jenis option[value="0"]').remove();
                    $('#kategori option[value="0"]').remove();

                    $('.select2').empty().select2({
                        theme: 'bootstrap4',
                        data: select2Data
                    });
                },
                error: function(error) {
                    console.error('Error fetching jenis data:', error);
                }
            });
        });

        @if ($errors->any())
            $('#tambahAsset').modal('show')
        @endif
    </script>
@endpush

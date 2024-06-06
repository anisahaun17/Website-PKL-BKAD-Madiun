@section('title', 'Penanggung Jawab')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#tambahPj">
            <i class="fas fa-plus-square"></i>
            Tambah Penanggung Jawab
        </button>
        <div class="modal fade" id="tambahPj">
            <div class="modal-dialog">
                <form action="{{ route('pj.store') }}" method="POST">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title">Form Tambah Penanggung Jawab</h4>
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
                                <label for="" class="form-label">NIP</label>
                                <input type="text" class="form-control" name="nip" id="nip"
                                    value="{{ old('nip') }}">
                                @error('nip')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Jabatan</label>
                                <select class="form-control" name="jabatan" id="jabatan">
                                    @foreach ($data['jabatan'] as $resJabatan)
                                        <option value="{{ $resJabatan->id }}">
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
                                    <option value="Aktif">Aktif
                                    </option>
                                    <option value="Non Aktif">
                                        Non
                                        Aktif
                                    </option>
                                </select>
                                @error('status')
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
                    <h3 class="card-title">Title</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['pj'] as $index => $resPJ)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $resPJ->nama }}</td>
                                    <td>{{ $resPJ->nip }}</td>
                                    <td>{{ $resPJ->jabatan->nama }}</td>
                                    <td>{{ $resPJ->status }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button onclick="window.location.href='{{ route('pj.edit', $resPJ->id) }}'"
                                                type="button" class="btn btn-warning btn-flat">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="{{ route('pj.delete', $resPJ->id) }}" class="btn btn-danger btn-flat"
                                                data-confirm-delete="true">
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
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('template') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('template') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('template') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('template') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('template') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('template') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('template') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "paging": true,
                "autoWidth": false,
            })
        });

        @if ($errors->any())
            $('#tambahPj').modal('show')
        @endif
    </script>
@endpush

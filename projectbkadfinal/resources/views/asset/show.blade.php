@section('title', 'Asset')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <button type="button" onclick="window.location.href='{{ route('asset.index') }}'" class="btn btn-warning mb-3">
            <i class="fas fa-angle-double-left"></i>
            Kembali
        </button>
        <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#tambahAsset">
            <i class="fas fa-plus-square"></i>
            Tambah Detail Aset
        </button>
        <div class="modal fade" id="tambahAsset">
            <div class="modal-dialog">
                <form action="{{ route('asset-detail.store') }}" method="POST">
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
                                <label for="" class="form-label">Panjang</label>
                                <input type="text" class="form-control" name="panjang" id="panjang"
                                    value="{{ old('panjang') }}">
                                @error('panjang')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Lebar</label>
                                <input type="text" class="form-control" name="lebar" id="lebar"
                                    value="{{ old('lebar') }}">
                                @error('lebar')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Jumlah Aset</label>
                                <input type="text" class="form-control" name="jumlah_asset" id="jumlah_asset"
                                    value="{{ old('jumlah_asset') }}">
                                @error('jumlah_asset')
                                    <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" name="asset_id" id="asset_id" value="{{ $data['asset']->id }}">
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
                    <h3 class="card-title">Asset {{ $data['asset']->nama }}</h3>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <th class="col-1">Nama</th>
                            <td>:</td>
                            <td>{{ $data['asset']->nama }}</td>
                        </tr>
                        <tr>
                            <th class="col-1">Lokasi</th>
                            <td>:</td>
                            <td>{{ $data['asset']->lokasi }}</td>
                        </tr>
                        <tr>
                            <th class="col-1">Jenis</th>
                            <td>:</td>
                            <td>{{ $data['asset']->jenis->nama }}</td>
                        </tr>
                        <tr>
                            <th class="col-1">Tarif</th>
                            <td>:</td>
                            <td>{{ 'Rp' . number_format($data['asset']->jenis->tarif, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Detail Aset</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Panjang</th>
                                <th>Lebar</th>
                                <th>Luas</th>
                                <th>Tarif</th>
                                <th>Jumlah Aset</th>
                                <th>Jumlah Tersedia</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['asset']->assetDetail as $index => $resAssetDetail)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $resAssetDetail->panjang }}</td>
                                    <td>{{ $resAssetDetail->lebar }}</td>
                                    <td>{{ $resAssetDetail->luas }}</td>
                                    <td>{{ 'Rp' . number_format($resAssetDetail->tarif, 0, ',', '.') }} / aset</td>
                                    <td>{{ $resAssetDetail->jumlah_asset }}</td>
                                    <td>{{ $resAssetDetail->jumlah_tersedia }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button
                                                onclick="window.location.href='{{ route('asset-detail.edit', $resAssetDetail->id) }}'"
                                                type="button" class="btn btn-warning btn-flat">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('asset-detail.delete', $resAssetDetail->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-flat" data-confirm-delete="true">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
            $('#tambahAsset').modal('show')
        @endif
    </script>
@endpush

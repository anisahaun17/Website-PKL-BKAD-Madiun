@section('title', 'Sewa')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <button type="button" onclick="window.location.href='{{ route('sewa.index') }}'" class="btn btn-warning mb-3">
            <i class="fas fa-angle-double-left"></i>
            Kembali
        </button>
        <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#tambahAssetSewa">
            <i class="fas fa-plus-square"></i>
            Tambah Aset Sewa
        </button>
        <div class="modal fade" id="tambahAssetSewa">
            <div class="modal-dialog modal-xl">
                <form action="{{ route('sewa-detail.store') }}" method="POST">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title">Form Tambah Asset Sewa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Asset</label>
                                        <select class="form-control select2" name="asset" id="asset">
                                            <option value="" disabled selected>Silahkan pilih asset</option>
                                            @foreach ($data['sewa']->asset->assetDetail as $resAssetDetail)
                                                <option value="{{ $resAssetDetail->id }}">
                                                    {{ $resAssetDetail->panjang . ' x ' . $resAssetDetail->lebar }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('asset')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control" name="jumlah" id="jumlah"
                                            value="{{ old('jumlah') }}">
                                        @error('jumlah')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="kode_transaksi" id="kode_transaksi" required
                                value="{{ $data['sewa']->kode_transaksi }}">
                            <div class="table-responsive">
                                <table id="table1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Panjang</th>
                                            <th>Lebar</th>
                                            <th>Luas</th>
                                            <th>Tarif (Per asset)</th>
                                            <th>Jumlah Tersedia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
                    <h3 class="card-title">Kode Transaksi {{ $data['sewa']->kode_transaksi }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <table>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->kode_transaksi }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->telepon }}</td>
                                </tr>
                                <tr>
                                    <th>NPWR</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->npwr }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->alamat }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            <table>
                                <tr>
                                    <th class="col-3">Nama Asset</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->asset->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Kategori</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->asset->jenis->kategori->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3 align-top">Jenis</th>
                                    <td class="align-top">:</td>
                                    <td class="text-wrap">{{ $data['sewa']->asset->jenis->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Sewa Mulai</th>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($data['sewa']->tgl_sewa_mulai)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Sewa Selesai</th>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($data['sewa']->tgl_sewa_selesai)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Status SKRD</th>
                                    <td>:</td>
                                    <td>Belum Terbit</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Jumlah Asset</th>
                                    <td>:</td>
                                    <td>{{ $data['sewa']->sewaDetail->sum('jumlah') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Detail Asset</h3>
                </div>
                <div class="card-body">
                    <table id="table2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Panjang</th>
                                <th>Lebar</th>
                                <th>Luas</th>
                                <th>Harga Total</th>
                                <th>Jumlah Sewa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['sewa']->sewaDetail as $index => $resSewaDetail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $resSewaDetail->assetDetail->asset->nama }}</td>
                                    <td>{{ $resSewaDetail->assetDetail->asset->lokasi }}</td>
                                    <td>{{ $resSewaDetail->assetDetail->asset->jenis->kategori->nama }}</td>
                                    <td>{{ $resSewaDetail->assetDetail->asset->jenis->nama }}</td>
                                    <td>{{ $resSewaDetail->assetDetail->panjang }}</td>
                                    <td>{{ $resSewaDetail->assetDetail->lebar }}</td>
                                    <td>{{ $resSewaDetail->assetDetail->luas }}</td>
                                    <td>{{ 'Rp' .number_format($resSewaDetail->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $resSewaDetail->jumlah }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('sewa-detail.delete', $resSewaDetail->id) }}"
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
        var dataTable = $("#table1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "paging": true,
            "autoWidth": false,
        })

        $("#table2").DataTable({
            "responsive": true,
            "lengthChange": true,
            "paging": true,
            "autoWidth": false,
        })

        $('#select2').selec

        function updateDataTable(assetId) {
            var url = "{{ route('api.assetDetailById', 'asset_id') }}"

            $.ajax({
                url: url.replace('asset_id', assetId),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    dataTable.clear();
                    console.log(data)
                    dataTable.row.add([
                        data.panjang,
                        data.lebar,
                        data.luas,
                        data.tarif,
                        data.jumlah_tersedia,
                    ]);

                    dataTable.draw();
                },
                error: function(error) {
                    console.error('Error fetching updated asset data:', error);
                }
            });
        }

        $('#asset').change(function() {
            var selectedAssetId = $(this).val();
            if (selectedAssetId) {
                updateDataTable(selectedAssetId);
            }
        });

        @if ($errors->any())
            $('#tambahAssetSewa').modal('show')
        @endif
    </script>
@endpush

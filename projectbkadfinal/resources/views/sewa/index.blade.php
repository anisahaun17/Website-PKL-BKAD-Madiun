@section('title', 'Sewa')
@extends('layout')
@section('content')
    <div class="container-fluid">
        <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#tambahSewa">
            <i class="fas fa-plus-square"></i>
            Tambah Penyewa
        </button>
        <div class="modal fade" id="tambahSewa">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('sewa.store') }}" method="POST">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h4 class="modal-title">Form Tambah Sewa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            value="{{ old('nama') }}">
                                        @error('nama')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Telepon</label>
                                        <input type="text" class="form-control" name="telepon" id="telepon"
                                            value="{{ old('telepon') }}">
                                        @error('telepon')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">NPWR</label>
                                        <input type="text" class="form-control" name="npwr" id="npwr"
                                            value="{{ old('npwr') }}">
                                        @error('npwr')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">NIK</label>
                                        <input type="text" class="form-control" name="nik" id="nik"
                                            value="{{ old('nik') }}">
                                        @error('nik')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Alamat</label>
                                        <textarea type="text" class="form-control" name="alamat" id="alamat">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Tanggal Sewa</label>
                                        <input type="date" class="form-control" name="tgl_sewa_mulai" id="tgl_sewa_mulai"
                                            value="{{ old('tgl_sewa_mulai') ? \Carbon\Carbon::parse(old('tgl_sewa_mulai'))->format('d-m-Y') : '' }}">
                                        @error('tgl_sewa_mulai')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Lama Sewa</label>
                                        <input type="number" class="form-control" name="lama_sewa" id="lama_sewa"
                                            value="{{ old('lama_sewa') }}">
                                        @error('lama_sewa')
                                            <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
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
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Jenis Pelayanan    </label>
                                        <select class="form-control select2Jenis" name="jenis" id="jenis"
                                            style="width: 100%;">
                                            <option value="0" disabled selected>Silahkan pilih kategori</option>
                                        </select>
                                        @error('jenis')
                                            <small
                                                class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Aset</label>
                                        <select class="form-control select2Asset" name="asset" id="asset"
                                            style="width: 100%;">
                                            <option value="0" disabled selected>Silahkan pilih aset</option>
                                        </select>
                                        @error('asset')
                                            <small
                                                class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 table-responsive">
                                    <table id="table1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Panjang</th>
                                                <th>Lebar</th>
                                                <th>Luas</th>
                                                <th>Tarif (Per aset)</th>
                                                <th>Jumlah Tersedia</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
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
                    <h3 class="card-title">List Penyewa</h3>
                </div>
                <div class="card-body">
                    <table id="table2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Transaksi</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Nama Asset</th>
                                <th>Sewa Mulai</th>
                                <th>Sewa Selesai</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['sewa'] as $index => $resSewa)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $resSewa->kode_transaksi }}</td>
                                    <td>{{ $resSewa->nama }}</td>
                                    <td>{{ $resSewa->nik }}</td>
                                    <td>{{ $resSewa->asset->nama }}</td>
                                    <td>{{ \Carbon\Carbon::parse($resSewa->tgl_sewa_mulai)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($resSewa->tgl_sewa_selesai)->format('d-m-Y') }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button
                                                onclick="window.location.href='{{ route('sewa.detail', $resSewa->kode_transaksi) }}'"
                                                type="button" class="btn btn-info btn-flat">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button
                                                onclick="window.location.href='{{ route('sewa.edit', $resSewa->kode_transaksi) }}'"
                                                type="button" class="btn btn-warning btn-flat">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="{{ route('sewa.delete', $resSewa->kode_transaksi) }}"
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

        function updateDataTable(assetId) {
            var url = "{{ route('api.assetDetailByJenis', 'asset_id') }}"

            $.ajax({
                url: url.replace('asset_id', assetId),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    dataTable.clear();

                    for (var i = 0; i < data.length; i++) {
                        dataTable.row.add([
                            i + 1,
                            data[i].panjang,
                            data[i].lebar,
                            data[i].luas,
                            data[i].tarif,
                            data[i].jumlah_tersedia,
                        ]);
                    }

                    dataTable.draw();
                },
                error: function(error) {
                    console.error('Error fetching updated asset data:', error);
                }
            });
        }

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
                    var silahkanPilihOption = [{
                        id: 0,
                        text: 'Silahkan pilih jenis',
                        selected: true
                    }];

                    var select2Data = silahkanPilihOption.concat(data.map(function(resJenis) {
                        return {
                            id: resJenis.id,
                            text: resJenis.nama
                        };
                    }));

                    $('#kategori option[value="0"]').remove();
                    $('#jenis option[value="0"]').remove();

                    $('.select2Jenis').empty().select2({
                        theme: 'bootstrap4',
                        data: select2Data
                    });
                },
                error: function(error) {
                    console.error('Error fetching jenis data:', error);
                }
            });
        });

        $('#jenis').change(function(e) {
            var jenis = $(this).val();
            var url = "{{ route('api.assetByJenis', 'jenis_id') }}"

            $.ajax({
                url: url.replace('jenis_id', jenis),
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    var silahkanPilihOption = [{
                        id: 0,
                        text: 'Silahkan pilih asset',
                        selected: true
                    }];

                    var select2Data = silahkanPilihOption.concat(data.map(function(resAsset) {
                        return {
                            id: resAsset.id,
                            text: resAsset.nama
                        };
                    }));

                    $('#asset option[value="0"]').remove();

                    $('.select2Asset').empty().select2({
                        theme: 'bootstrap4',
                        data: select2Data
                    });
                },
                error: function(error) {
                    console.error('Error fetching jenis data:', error);
                }
            });
        });

        $('#asset').change(function() {
            var selectedAssetId = $(this).val();
            if (selectedAssetId) {
                updateDataTable(selectedAssetId);
            }
        });

        @if ($errors->any())
            $('#tambahSewa').modal('show')
        @endif
    </script>
@endpush

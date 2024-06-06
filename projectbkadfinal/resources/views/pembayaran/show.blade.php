@section('title', 'Pembayaran')
@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Detail Pembayaran</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <table>
                                <tr>
                                    <th>Kode Transaksi</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->kode_transaksi }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->nik }}</td>
                                </tr>
                                <tr>
                                    <th>Telepon</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->telepon }}</td>
                                </tr>
                                <tr>
                                    <th>NPWR</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->npwr }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->alamat }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            <table>
                                <tr>
                                    <th class="col-3">Nama Asset</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->asset->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Kategori</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->asset->jenis->kategori->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3 align-top">Jenis</th>
                                    <td class="align-top">:</td>
                                    <td class="text-wrap">{{ $data['pembayaran']->skrd->sewa->asset->jenis->nama }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Sewa Mulai</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->tgl_sewa_mulai }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Sewa Selesai</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->tgl_sewa_selesai }}</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Status SKRD</th>
                                    <td>:</td>
                                    <td>Belum Terbit</td>
                                </tr>
                                <tr>
                                    <th class="col-3">Jumlah Asset</th>
                                    <td>:</td>
                                    <td>{{ $data['pembayaran']->skrd->sewa->sewaDetail->sum('jumlah') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col text-right">
                            <button onclick="window.open('{{ route('print.pembayaran', request()->pembayaran) }}')"
                                type="button" class="btn btn-flat btn-info col-2 mt-3">
                                <i class="fas fa-print"></i>
                                Print Nota
                            </button>
                        </div>
                    </div>

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

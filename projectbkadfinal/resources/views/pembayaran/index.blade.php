@section('title', 'Pembayaran')
@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">List Pembayaran</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nama Asset</th>
                                <th>Total Harga</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['pembayaran'] as $index => $resPembyaran)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $resPembyaran->skrd->sewa->nama }}</td>
                                    <td>{{ $resPembyaran->skrd->sewa->asset->nama }}</td>
                                    <td>{{ 'Rp.' . number_format($resPembyaran->total, '0', ',', '.') }}</td>
                                    <td>{{ $resPembyaran->tanggal_pembayaran }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button
                                                onclick="window.location.href='{{ route('pembayaran.detail', $resPembyaran->id) }}'"
                                                type="button" class="btn btn-info btn-flat">
                                                <i class="fas fa-eye"></i>
                                            </button>
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
    </script>
@endpush

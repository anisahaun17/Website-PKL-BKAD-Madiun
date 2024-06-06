@section('title', 'SKRD')
@extends('layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Default box -->
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title">Daftar SKRD {{ str_replace('-', ' ', ucwords(request()->status)) }}</h3>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Penyewa</th>
                                <th>Nama Aset</th>
                                <th>Mulai Sewa</th>
                                <th>Akhir Sewa</th>
                                <th class="{{ request()->status == 'belum-terbit' ? 'd-none' : '' }}">Denda</th>
                                <th class="{{ request()->status == 'belum-terbit' ? 'd-none' : '' }}">Pengurangan</th>
                                <th class="{{ request()->status == 'belum-terbit' ? 'd-none' : '' }}">Tanggal Terbit</th>
                                <th class="{{ request()->status == 'selesai' ? 'd-none' : '' }}">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (request()->status == 'belum-terbit')
                                @foreach ($data['skrd'] as $index => $resSkrd)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $resSkrd->nama }}</td>
                                        <td>{{ $resSkrd->asset->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($resSkrd->tgl_sewa_mulai)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($resSkrd->tgl_sewa_selesai)->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.open('{{ route('sewa.detail', $resSkrd->kode_transaksi) }}')"
                                                    type="button" class="btn btn-info btn-flat">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    onclick="window.location.href='{{ route('skrd.store', ['penanggungJawab' => $data['penanggungJawab'], 'sewa' => $resSkrd->kode_transaksi]) }}'"
                                                    type="button" class="btn btn-success btn-flat">
                                                    <i class="fas fa-plus-square"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if (request()->status == 'terbit')
                                @foreach ($data['skrd'] as $index => $resSkrd)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $resSkrd->sewa->nama }}</td>
                                        <td>{{ $resSkrd->sewa->asset->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($resSkrd->sewa->tgl_sewa_mulai)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($resSkrd->sewa->tgl_sewa_selesai)->format('d-m-Y') }}</td>
                                        <td>{{ 'Rp' . number_format($resSkrd->denda, 0, ',', '.') }}</td>
                                        <td>{{ 'Rp' . number_format($resSkrd->pengurangan, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($resSkrd->tanggal_cetak)->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <button
                                                    onclick="window.location.href='{{ route('skrd.update', ['skrd' => $resSkrd->id, 'status' => 'denda']) }}'"
                                                    type="button" class="btn btn-danger btn-flat">
                                                    <i class="fas fa-hand-holding-usd"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary btn-flat" data-toggle="modal"
                                                    data-target="#pengurangan-{{ $index + 1 }}">
                                                    <i class="fas fa-percentage"></i>
                                                </button>
                                                <a href="{{ route('print.skrd', ['skrd' => $resSkrd->id]) }}" class="btn btn-success btn-flat">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal"
                                                    data-target="#lunas-{{ $index + 1 }}">
                                                    <i class="far fa-handshake"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <div class="modal fade" id="lunas-{{ $index + 1 }}">
                                        <div class="modal-dialog modal-lg">
                                            <form action="{{ route('pembayaran.store', $resSkrd->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h4 class="modal-title">Form Pelunasan</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">Tanggal
                                                                Pembayaran</label>
                                                            <input type="date" class="form-control"
                                                                name="tanggal_pembayaran" id="tanggal_pembayaran"
                                                                value="{{ old('tanggal_pembayaran') ?? date('Y-m-d', time()) }}">
                                                            @error('tanggal_pembayaran')
                                                                <small
                                                                    class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="" class="form-label">Petugas
                                                                Penerima</label>
                                                            <select class="form-control" name="petugas" id="petugas">
                                                                @foreach ($data['petugas'] as $resPetugas)
                                                                    <option value="{{ $resPetugas->id }}">
                                                                        {{ $resPetugas->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('petugas')
                                                                <small
                                                                    class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="submit" class="btn btn-info">Terima Pembayaran</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batalkan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <div class="modal fade" id="pengurangan-{{ $index + 1 }}">
                                        <div class="modal-dialog modal-lg">
                                            <form
                                                action="{{ route('skrd.update', ['skrd' => $resSkrd->id, 'status' => 'pengurangan']) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-content">
                                                    <div class="modal-header bg-info">
                                                        <h4 class="modal-title">Form tambah pengurangan</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="" class="form-label">Pengurangan (%)</label>
                                                            <div class="input-group"> 
                                                                <input type="number" class="form-control" name="persentase" id="persentase" value="{{ old('persentase') }}" step="0.1">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                            @error('persentase')
                                                                <small class="text-danger font-italic font-weight-bold">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="submit" class="btn btn-info">Ubah</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batalkan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                @endforeach
                            @endif
                            @if (request()->status == 'selesai')
                                @foreach ($data['skrd'] as $index => $resSkrd)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $resSkrd->sewa->nama }}</td>
                                        <td>{{ $resSkrd->sewa->asset->nama }}</td>
                                        <td>{{ $resSkrd->sewa->tgl_sewa_mulai }}</td>
                                        <td>{{ $resSkrd->sewa->tgl_sewa_selesai }}</td>
                                        <td>{{ $resSkrd->denda }}</td>
                                        <td>{{ $resSkrd->pengurangan }}</td>
                                        <td>{{ $resSkrd->tanggal_cetak }}</td>
                                    </tr>
                                @endforeach
                            @endif
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

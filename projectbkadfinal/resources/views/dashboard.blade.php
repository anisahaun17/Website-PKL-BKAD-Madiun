@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Dashboard</h3>
                    </div>
                    <div class="card-body">
                        Welcome {{ ucwords(Auth::user()->nama) }} <span class="fs-1">👋</span>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Tambah Hari Libur</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Dashboard Admin</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Tambah Hari Libur
                        </li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Tambah Hari Libur
                            </h3>
                        </div>
                        @include('messages.alerts')
                        <form action="{{ route('admin.holidays.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Lebih Dari Sehari ?</label>
                                    <select name="multiple-days" class="form-control" onchange="showInput()">
                                        <option value="no">Tidak</option>
                                        <option value="yes">Ya</option>
                                    </select>
                                </div>
                                <div class="form-group" id="single-date">
                                    <label for="">Seleksi Tanggal </label>
                                    <input type="text" name="date" id="date1" class="form-control">
                                </div>
                                <div class="form-group hide-input" id="multiple-date">
                                    <label for="">Rentang Tanggal</label>
                                    <input type="text" name="date_range" id="date2" class="form-control">
                                    @error('date_range')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

@section('extra-js')

<script>
    $(document).ready(function() {
        $('#date1').daterangepicker({
            "showDropdowns": true,
            "singleDatePicker": true,
            "locale": {
                "format": "DD-MM-YYYY",
            }
        });
        $('#date2').daterangepicker({
            "showDropdowns": true,
            "locale": {
                "format": "DD-MM-YYYY",
            }
        });

    });

    function showInput() {
        $('#single-date').toggleClass('hide-input');
        $('#multiple-date').toggleClass('hide-input');
    }
</script>
@endsection
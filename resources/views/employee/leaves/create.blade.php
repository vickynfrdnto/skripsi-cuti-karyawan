@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Ajukan Cuti</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.index') }}">Dashboard Karyawan</a>
                        </li>
                        <li class="breadcrumb-item active">Ajukan Cuti</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ajukan Cuti</h3>
                        </div>
                        @include('messages.alerts')
                        <form action="{{ route('employee.leaves.store', $employee->id) }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Alasan</label>
                                    <select class="form-control" name="reason">
                                        <option value="Sakit">Cuti Sakit</option>
                                        <option value="Cuti">Cuti Tahunan</option>
                                        <option value="Melahirkan">Cuti Melahirkan</option>
                                        <option value="Menikah">Cuti Menikah</option>
                                        <option value="Berduka">Cuti Berduka</option>
                                    </select>

                                    @error('reason')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Lebih dari Sehari?</label>
                                    <select class="form-control" name="multiple-days" onchange="showDate()">
                                        <option value="yes" selected>Ya</option>
                                        <option value="no">Tidak</option>
                                    </select>
                                </div>

                                <div class="form-group hide-input" id="half-day">
                                    <label>Setengah Jam Kerja</label>
                                    <select class="form-control" name="half-day">
                                        <option value="no">Tidak</option>
                                        <option value="yes">Ya</option>
                                    </select>
                                </div>

                                <div class="form-group" id="range-group">
                                    <label for="">Rentang Tanggal: </label>
                                    <input type="text" name="date_range" id="date_range" class="form-control">
                                    @error('date_range')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group hide-input" id="date-group">
                                    <label for="">Tanggal</label>
                                    <input type="text" name="date" id="date" class="form-control">
                                </div>
                            </div>

                            <div class="alert alert-info">
                                Sisa Cuti Anda: <strong>{{ $sisa_cuti }}</strong> hari
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary" type="submit">Ajukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra-js')
<script>
    $(document).ready(function() {
        $('#date_range').daterangepicker({
            "locale": {
                "format": "DD-MM-YYYY",
            }
        });

        $('#date').daterangepicker({
            "singleDatePicker": true,
            "locale": {
                "format": "DD-MM-YYYY",
            }
        });
    });

    function showDate() {
        $('#range-group').toggleClass('hide-input');
        $('#date-group').toggleClass('hide-input');
        $('#half-day').toggleClass('hide-input');
    }
</script>
@endsection

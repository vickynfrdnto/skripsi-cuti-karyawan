@extends('layouts.app')        

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Absensi</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.index') }}">Dashboard Karyawan</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Daftar Absensi
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
                <div class="col-md-3 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-center text-primary" style="text-align: center !important">Cari Absensi dengan rentang tanggal</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mx-auto text-center">
                                    <form action="{{ route('employee.attendance.index') }}" method="POST">
                                        @csrf
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="">Rentang Tanggal</label>
                                                <input type="text" name="date_range" placeholder="Start Date" class="form-control text-center"
                                                id="date_range"
                                                >
                                                @error('date_range')
                                                <div class="ml-2 text-danger">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </fieldset>
                                        
                                            <input type="submit" name="" class="btn btn-primary" value="Submit">
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            {{-- <div class="container">
                                <form action="{{ route('employee.attendance.index') }}" class="row" method="POST">
                                    @csrf
                                    <div class="col-sm-9 mb-2">

                                        <div class="input-group">
                                            <input type="text" name="date_range" placeholder="Start Date" class="form-control"
                                            id="date_range"
                                            >
                                        </div>
                                        @error('date_range')
                                        <div class="ml-2 text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <div class="input-group">
                                            <input type="submit" name="" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>
                                    
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title text-center">
                                Absensi
                                @if ($filter)
                                    dari rentang
                                @endif
                            </div>
                            
                        </div>
                        <div class="card-body">
                            @if ($attendances->count())
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Waktu Absensi</th>
                                        <th>Lokasi Absensi</th>
                                        <th>Waktu Selesai</th>
                                        <th>Lokasi Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($attendances as $index => $attendance)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        @if ($attendance->registered == 'yes')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-success">Hadir</span> </h5></td>
                                        <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                                        <td>{{ $attendance->entry_location }}</td>
                                        <td>{{ $attendance->updated_at->format('H:i:s') }}</td>
                                        <td>{{ $attendance->exit_location }}</td>
                                        @elseif($attendance->registered == 'no')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-danger">Absen</span> </h5></td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        @elseif($attendance->registered == 'sun')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-info">Minggu</span> </h5></td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        @elseif($attendance->registered == 'leave')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-info">Leave</span> </h5></td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        @elseif($attendance->registered == 'holiday')
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-success">Hari Libur</span> </h5></td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        <td class="text-center">Belum Ada Riwayat</td>
                                        @else
                                        <td>{{ $attendance->created_at->format('d-m-Y') }}</td>
                                        <td><h5 class="text-center"><span class="badge badge-pill badge-warning">Setengah Jam Kerja</span> </h5></td>
                                        <td>{{ $attendance->created_at->format('H:i:s') }}</td>
                                        <td>{{ $attendance->entry_location }}</td>
                                        <td> - </td>
                                        <td> - </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>Data Tidak Ada</h4>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                    <!-- general form elements -->
                    
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
        $('#dataTable').DataTable({
            responsive:true,
            autoWidth: false,
        });
        $('#date_range').daterangepicker({
            "maxDate": new Date(),
            "locale": {
                "format": "DD-MM-YYYY",
            }
        })
    });
</script>
@endsection
@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Daftar Cuti</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('employee.index') }}">Dashboard Karyawan</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Daftar Cuti
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
                <div class="col-lg-12 col-md-10 mx-auto">
                    <!-- general form elements -->
                    @include('messages.alerts')
                    <div class="card card-primary">
                        <div class="card-header d-flex align-items-center">
                            <div class="card-title">
                                <h3 class="">Daftar Cuti</h3>
                            </div>
                            {{-- <div class="ml-auto">
                                <a
                                    href="{{ route('employee.leaves.create') }}"
                                    class="nav-link"
                                >
                                    Tambah <i class="fa-solid fa-circle-plus"></i>
                                </a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="mb-xl-3">
                                <a class="btn btn-outline-primary" href="{{ route('employee.leaves.create')}}">
                                    <i class="fas fa-solid fa-plus mr-2"></i>Tambah</a>
                            </div>
                            @if ($leaves->count())
                            <table class="table table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Ajuan</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Setengah Hari Kerja</th>
                                        <th>Mulai Cuti</th>
                                        <th>Akhir Cuti</th>
                                        <th class="none">Deskripsi</th>
                                        <td class="none">Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $index => $leave)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $leave->created_at->format('d-m-Y') }}</td>
                                        <td>{{
                                                [
                                                    'Cuti' => 'Cuti Tahunan',
                                                    'Sakit' => 'Cuti Sakit',
                                                    'Melahirkan' => 'Cuti Melahirkan',
                                                    'Menikah' => 'Cuti Menikah',
                                                    'Berduka' => 'Cuti Berduka'
                                                ][$leave->reason] ?? $leave->reason
                                            }}
                                        </td>
                                        <td>
                                            <h5>
                                                <span
                                                @if ($leave->status == 'pending')
                                                    class="badge badge-pill badge-warning"
                                                @elseif($leave->status == 'declined')
                                                    class="badge badge-pill badge-danger"
                                                @elseif($leave->status == 'approved')
                                                    class="badge badge-pill badge-success"
                                                @endif
                                                >
                                                    {{ ucfirst($leave->status) }}
                                                </span>
                                            </h5>
                                        </td>
                                        <td>{{ ucfirst($leave->half_day) }}</td>
                                        <td>{{ $leave->start_date->format('d-m-Y')}}</td>
                                        @if($leave->end_date)
                                        <td>{{ $leave->end_date->format('d-m-Y') }}</td>
                                        @else
                                        <td>Single Day</td>
                                        @endif
                                        <td>{{ $leave->description }}</td>
                                        <td>
                                            @if ($leave->status == "pending")
                                                <a href="{{ route('employee.leaves.edit', $leave->id) }}" class="btn btn-flat btn-warning">Edit</a>
                                            @endif
                                            <button type="button" class="btn btn-flat btn-danger"
                                            data-toggle="modal"
                                            data-target="#deleteModalCenter{{ $index + 1 }}"
                                            >
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @for ($i = 1; $i < $leaves->count()+1; $i++)
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModalCenter{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle1{{ $i }}" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="card card-danger">
                                                <div class="card-header">
                                                    <h5 style="text-align: center !important">Yakin ingin dihapus?</h5>
                                                </div>
                                                <div class="card-body text-center d-flex" style="justify-content: center">

                                                    <button type="button" class="btn flat btn-secondary" data-dismiss="modal">Tidak</button>

                                                    <form
                                                    action="{{ route('employee.leaves.delete', $leaves->get($i-1)->id) }}"
                                                    method="POST"
                                                    >
                                                    @csrf
                                                    @method('DELETE')
                                                        <button type="submit" class="btn flat btn-danger ml-1">Ya</button>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small>Informasi Tidak Bisa Diubah</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->
                            @endfor
                            @else
                            <div class="alert alert-info text-center" style="width:50%; margin: 0 auto">
                                <h4>Tidak Ada Data</h4>
                            </div>
                            @endif
                        </div>
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
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $('.popover-dismiss').popover({
        trigger: 'focus'
    });
    $('#dataTable').DataTable({
        responsive:true,
        autoWidth: false,
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: 1 },
            { responsivePriority: 200000000000, targets: -1 }
        ]
    });
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
});
</script>
@endsection

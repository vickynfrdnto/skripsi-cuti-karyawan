@extends('layouts.app')
@section('tittle', 'Web Absensi | Daftar Karyawan')

@section('content')
<style>
    .card-header .ml-auto {
        margin-left: auto;
    }
</style>
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Daftar Karyawan</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.index') }}">Dashboard Admin</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Daftar Karyawan
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
        @include('messages.alerts')
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card card-primary">
                    <div class="card-header d-flex align-items-center">
                        <div class="card-title">
                            Karyawan
                        </div>
                        {{-- <div class="ml-auto">
                            <a
                                href="{{ route('admin.employees.create') }}"
                                class="nav-link"
                            >
                                Tambah <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="mb-xl-3">
                            <a class="btn btn-outline-primary" href="{{ route('admin.employees.create')}}">
                                <i class="fas fa-solid fa-plus mr-2"></i>Tambah</a>
                        </div>
                        @if ($employees->count())
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Department</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Gaji</th>
                                    <th class="none">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $index => $employee)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $employee->first_name.' '.$employee->last_name }}</td>
                                    <td>{{ $employee->department->name }}</td>
                                    <td>{{ $employee->desg }}</td>
                                    <td>{{ $employee->join_date->format('d M, Y') }}</td>
                                    <td>Rp. {{ number_format($employee->salary) }}</td>
                                    <td>
                                        <a href="{{ route('admin.employees.profile', $employee->id) }}" class="btn btn-flat btn-info">Lihat Profil</a>
                                        <button
                                        class="btn btn-flat btn-danger"
                                        data-toggle="modal"
                                        data-target="#deleteModalCenter{{ $index + 1 }}"
                                        >Hapus Karyawan</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                            @for ($i = 1; $i < $employees->count()+1; $i++)
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
                                                    action="{{ route('admin.employees.delete', $employees->get($i-1)->id) }}"
                                                    method="POST"
                                                    >
                                                    @csrf
                                                    @method('DELETE')
                                                        <button type="submit" class="btn flat btn-danger ml-1">Ya</button>
                                                    </form>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <small>Aksi ini tidak bisa dilakukan</small>
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
    });
</script>
@endsection

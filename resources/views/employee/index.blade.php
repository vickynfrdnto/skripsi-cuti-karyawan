@extends('layouts.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Halaman Utama</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Dashboard
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
      <row class="">
        <div class="col-md-12 mx-auto">
          <div class="jumbotron text-center">
            <h3 class=" text-primary">Selamat Datang,
                <strong>
                    @if ($employee->sex == 'Male')
                    Bapak {{ $employee->first_name.' '.$employee->last_name }}
                    @else
                    Ibu {{ $employee->first_name.' '.$employee->last_name }}
                    @endif
                </strong></h3>
          </div>
          </div>
      </row>
      <h5 class="mb-2">Data</h5>
        <div class="row">
            <!-- Kolom kiri: 4 box cuti 2 per baris -->
            <div class="col-md-6 col-12">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <div class="info-box small-box">
                            <span class="info-box-icon bg-success"><i class="fa-solid fa-arrows-rotate"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Sisa Cuti :</span>
                                <span class="info-box-number">{{ $sisa_cuti }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="info-box small-box">
                            <span class="info-box-icon bg-info"><i class="fa-regular fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Cuti Pending :</span>
                                <span class="info-box-number">{{ $jml_pending }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="info-box small-box">
                            <span class="info-box-icon bg-warning"><i class="fa-regular fa-thumbs-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Cuti Disetujui :</span>
                                <span class="info-box-number">{{ $jml_approved }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="info-box small-box">
                            <span class="info-box-icon bg-danger"><i class="fa-solid fa-thumbs-down"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Cuti Ditolak :</span>
                                <span class="info-box-number">{{ $jml_declined }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Kolom kanan: Card Aktifitas -->
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header border-0 d-flex justify-content-between">
                        <h3 class="card-title">Aktifitas Terakhir Anda ({{ Auth::user()->name }})</h3>
                    </div>
                    <div class="card-body">
                        <!-- Aktifitas 1 -->
                        @foreach($aktifitas as $kegiatan)
                        <div class="d-flex mb-3">
                            <div class="text-center pr-3 border-right">
                                <small class="text-muted">{{ $kegiatan->created_at->translatedFormat('l') }}</small>
                                <h4 class="mb-0">{{ $kegiatan->created_at->translatedFormat('d') }}</h4>
                                <small class="text-muted">{{ $kegiatan->created_at->translatedFormat('F') }}</small>
                            </div>
                            <div class="pl-3">
                                <small class="text-muted">{{ $kegiatan->created_at->translatedFormat('H:i') }} WIB</small><br>
                                Mengajukan Cuti <span class="badge
                                    @if($kegiatan->status == 'pending') badge-warning
                                    @elseif($kegiatan->status == 'approved') badge-success
                                    @else badge-danger
                                    @endif
                                    ">
                                    {{ ucfirst($kegiatan->status) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Aktifitas 2 -->
            {{-- <div class="d-flex mb-3">
                <div class="text-center pr-3 border-right">
                    <small class="text-muted">{{ $aktifitas->created_at->translatedFormat('l') }}</small>
                    <h4 class="mb-0">{{ $aktifitas->created_at->translatedFormat('d') }}</h4>
                    <small class="text-muted">{{ $aktifitas->created_at->translatedFormat('F') }}</small>
                </div>
                <div class="pl-3">
                    <small class="text-muted">{{ $aktifitas->created_at->translatedFormat('H:i') }} WIB</small><br>
                    Mengajukan Cuti <span class="badge
                        @if($aktifitas->status == 'pending') badge-warning
                        @elseif($aktifitas->status == 'approved') badge-success
                        @else badge-danger
                        @endif
                        ">
                        {{ ucfirst($aktifitas->status) }}
                    </span>
                </div>
            </div> --}}

        </div>
    </div>
</div>

        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- /.content-wrapper -->

@endsection


@extends('layouts.app')
@section('tittle', 'Web Absensi | Dashboard')

@section('content')
{{-- <link href="/css/custom.css" rel="stylesheet"> --}}
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Selamat Datang, Admin</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Halaman Utama</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Dashboard Admin
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
        {{-- <row class="">
        <div class="col-md-12 mx-auto">
            <div class="jumbotron text-center">
                <h3 class="text-primary">Selamat Datang di Panel admin <br> <strong>PT. Mustikarama Citraperdana</strong></h3>
            </div>
        </div>
        </row> --}}

        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Data</h5>
            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exportPdfModal">
                <i class="fa-solid fa-file-pdf"></i> Download Laporan
            </button>

            <!-- Modal Export Harian -->
            <div class="modal fade" id="exportPdfModal" tabindex="-1" aria-labelledby="exportPdfModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="GET" action="{{ route('admin.export.harian') }}" id="exportPdfForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exportPdfModalLabel">Pilih Rentang Tanggal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="start_date">Tanggal Awal</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="end_date">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-file-pdf"></i> Export PDF
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Modal Export -->
            {{-- <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.export.data.employee', 'id_placeholder') }}" method="GET" id="exportForm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exportModalLabel">Export Data Cuti Pegawai</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="employeeSelect" class="form-label">Pilih Pegawai</label>
                                    <select id="employeeSelect" class="form-select" required>
                                        <option selected disabled>-- Pilih Pegawai --</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-solid fa-file-pdf"></i> Export PDF
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
            <!-- Modal Export Harian -->
            {{-- <div class="modal fade" id="exportPdfModal" tabindex="-1" role="dialog" aria-labelledby="exportPdfModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exportPdfModalLabel">Pilih Rentang Tanggal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="exportPdfForm" method="GET" action="{{ route('admin.export.harian') }}">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="start_date">Tanggal Awal</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">Tanggal Akhir</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Export PDF</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="info-box small-box">
                    <span class="info-box-icon bg-success"><i class="fa-solid fa-user"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Data Karyawan</span>
                    <span class="info-box-number">{{ $jml_akun }}</span>
                    </div>
                </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="info-box small-box">
                        <span class="info-box-icon bg-info"><i class="fa-regular fa-clock"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Data Cuti Pending</span>
                        <span class="info-box-number">{{ $jml_pending }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="info-box small-box">
                        <span class="info-box-icon bg-warning"><i class="fa-regular fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Data Cuti Diterima</span>
                        <span class="info-box-number">{{ $jml_approved }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-12 mb-3">
                    <div class="info-box small-box">
                        <span class="info-box-icon bg-danger"><i class="fa-solid fa-thumbs-down"></i></span>
                        <div class="info-box-content">
                        <span class="info-box-text">Data Cuti Ditolak</span>
                        <span class="info-box-number">{{ $jml_declined }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
            <!-- Bar chart -->
            <div class="card card-info card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  Bar Chart
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="bar-chart" style="height: 450px;"></canvas>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
            </div>
            <!-- Kolom kiri: 4 box cuti 2 per baris -->
            {{-- <div class="col-md-6 col-12">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <div class="info-box small-box">
                            <span class="info-box-icon bg-success"><i class="fa-solid fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Data Karyawan</span>
                                <span class="info-box-number">{{ $jml_akun }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="info-box small-box">
                            <span class="info-box-icon bg-info"><i class="fa-regular fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Data Cuti Pending :</span>
                                <span class="info-box-number">{{ $jml_pending }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="info-box small-box">
                            <span class="info-box-icon bg-warning"><i class="fa-regular fa-thumbs-up"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Data Cuti Diterima :</span>
                                <span class="info-box-number">{{ $jml_approved }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="info-box small-box">
                            <span class="info-box-icon bg-danger"><i class="fa-solid fa-thumbs-down"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Data Cuti Ditolak :</span>
                                <span class="info-box-number">{{ $jml_declined }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-6 col-10">
                <!-- Calendar -->
                    <div class="card card-info card-outline">
                        {{-- <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i> Kalender
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div> --}}
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fa-regular fa-calendar"></i>
                            Kalender
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div id="calendar" style="width: 100%;"></div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <!-- /.container-fluid -->

</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('bar-chart').getContext('2d');
  const chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode($cutiData->pluck('name')) !!},
      datasets: [{
        label: 'Jumlah Cuti',
        data: {!! json_encode($cutiData->pluck('total')) !!},
        backgroundColor: 'rgba(54, 162, 235, 0.7)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
        scales: {
            y: {
            beginAtZero: true,
            ticks: {
                precision: 0, // untuk sumbu Y
                callback: function(value) {
                return Math.round(value); // pastikan dibulatkan
                }
            }
            }
        },
        plugins: {
            tooltip: {
            callbacks: {
                label: function(context) {
                let label = context.dataset.label || '';
                if (label) {
                    label += ': ';
                }
                label += Math.round(context.parsed.y); // hilangkan desimal di tooltip
                return label;
                }
            }
            }
        }
        }
  });
</script>

<script>
    document.getElementById('exportForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('employeeSelect').value;
        if (id) {
            this.action = this.action.replace('id_placeholder', id);
            this.submit();
        }
    });
</script>
<style>
    .button-previous-month {
        font-size: 20px; /* Besarkan ukuran teks */
        padding: 12px 20px; /* Besarkan area tombol */
        width: 150px; /* Lebar tombol */
        height: 50px; /* Tinggi tombol */
    }

    .fc-day-sat, .fc-day-sun {
        background-color: #f0f0f0;
    }

    .fc-toolbar-title {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
    }

    .fc-holiday {
        background-color: #f56954 !important;
        color: white !important;
    }

    .fc .fc-daygrid-day-number {
        font-size: 0.8rem;
        padding: 4px;
    }

    /* Kurangi tinggi baris */
    .fc .fc-scrollgrid-section-body table {
        height: auto !important;}
</style>

<!-- /.content -->
<!-- /.content-wrapper -->

@endsection

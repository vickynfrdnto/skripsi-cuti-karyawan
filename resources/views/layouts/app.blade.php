<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{ Session::token() }}">
        <title>@yield('tittle')</title>
        {{-- <title>Web Absensi | Dashboard</title> --}}
        {{-- favicon --}}
        <link rel="icon" href="/img/partner.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="/plugins/fontawesome-free/css/all.min.css"
        />
        <!-- Ionicons -->
        <link
            rel="stylesheet"
            href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
        />
        {{-- Font awesome 4.7 --}}
        <link rel="stylesheet" href="/dist/css/font-awesome.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->

        <!-- Theme style -->
        <link rel="stylesheet" href="/dist/css/adminlte.min.css" />
        <!-- overlayScrollbars -->
        <link
            rel="stylesheet"
            href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
        />

        <!-- summernote -->
        <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.css" />
        <!-- Google Font: Source Sans Pro -->
        <link
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
            rel="stylesheet"
        />
        <!-- FullCalendar CSS -->
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">

        <!-- FullCalendar JS -->
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- DataTables -->
    <link
    rel="stylesheet"
    href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <link
    rel="stylesheet"
    href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    />
    <!-- daterange picker -->
    <link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker.css">
    {{-- <link rel="stylesheet" href="/css/daterangepicker.css"> --}}
    <style>
        .hide-input {
            display: none;
        }
        .proftable tr td:first-child {
            font-weight: bold;
            color: rgb(11, 72, 138);
        }
    </style>
    </head>
        @guest

        <body class="hold-transition login-page">
            {{-- If user is not logged in --}}
            @yield('content')

        @else
        @if (Route::currentRouteName() == 'password.request' || Route::currentRouteName() == 'password.reset' || Route::currentRouteName() == 'password.confirm')
        <body class="hold-transition login-page">
            {{-- If user is not logged in --}}
            @yield('content')
        @else
        <body class="hold-transition sidebar-mini layout-fixed">

            <div class="wrapper">
                {{-- navbar include --}}
                @include('includes.navbar')
                @include('includes.main_sidebar')
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                @yield('content')
                </div>
                <footer class="main-footer">
                    <strong>
                        By <a>Septiani Hesty Ningrum</a>.
                    </strong>

                    <div class="float-right d-none d-sm-inline-block">
                        <b>Versi</b> 1.0.0
                    </div>
                </footer>
                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
            </div>
            <!-- ./wrapper -->
        @endif

        @endguest

        <!-- FLOT CHARTS -->
        {{-- <script src="/plugins/flot/jquery.flot.js"></script> --}}

        <!-- jQuery -->
        <script src="/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge("uibutton", $.ui.button);
        </script>
        <!-- Bootstrap 4 -->
        <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Bootstrap 5 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Summernote -->
        <script src="/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/dist/js/adminlte.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        {{-- <script src="/dist/js/pages/dashboard.js"></script> --}}
        {{-- font awesome --}}
        {{-- <script src="https://use.fontawesome.com/2d4c4e3d51.js"></script> --}}
        <!-- AdminLTE for demo purposes -->
        <script src="/dist/js/demo.js"></script>
        <!-- DataTables -->
        <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <!-- InputMask -->
        <script src="/plugins/moment/moment.min.js"></script>
        <script src="/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
        <!-- date-range-picker -->
        <script src="/plugins/daterangepicker/daterangepicker.js"></script>
        {{-- <script src="/js/daterangepicker.js"></script> --}}
        {{-- <script src="/js/moment.min.js"></script> --}}
        {{-- <!-- calendar 1 -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listWeek'
                    },
                    events: [], // Atau ambil dari route: events: '/api/events'
                });

                calendar.render();
            });
        </script> --}}
        <!-- calendar 2 -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            // Daftar Hari Libur Nasional
            var holidays = [
                { title: 'Tahun Baru', start: '2025-01-01', className: 'fc-holiday' },
                { title: 'Hari Buruh', start: '2025-05-01', className: 'fc-holiday' },
                { title: 'Hari Kemerdekaan', start: '2025-08-17', className: 'fc-holiday' },
                { title: 'Maulid Nabi', start: '2025-09-05', className: 'fc-holiday' },
                { title: 'Natal', start: '2025-12-25', className: 'fc-holiday' }
            ];

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                locale: 'id', // Bahasa Indonesia
                height: 400,
                headerToolbar: {
                // left: 'prev,next today',
                // center: 'title',
                // right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: holidays
            });

            calendar.render();
            });
        </script>
        {{-- <style>
            .fc-holiday {
                background-color: #f56954 !important;
                color: white !important;
            }
        </style> --}}

        @yield('extra-js')
    </body>
</html>

@php
    use App\Employee;
    use App\Attendance;
    use App\Holiday;
    use App\Leave;

    $jumlahKaryawan = Employee::count();
    $absen = Attendance::count();
    $libur = Holiday::count();
    $cuti = Leave::where('status', 'pending')->count();
@endphp
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-check-o"></i>
        <p>
            Karyawan
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">3</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        {{-- <li class="nav-item">
            <a
                href="{{ route('admin.employees.create') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Tambah Karyawan</p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a
                href="{{ route('admin.employees.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Karyawan</p>
                <span class="badge badge-info right">{{ $jumlahKaryawan }}</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a
                href="{{ route('admin.employees.attendance') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Absensi Karyawan</p>
                <span class="badge badge-info right">{{ $absen }}</span>
            </a>
        </li> --}}
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-unlock-alt"></i>
        <p>
            Daftar Cuti Karyawan
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">2</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.leaves.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Cuti</p>
                <span class="badge badge-info right">{{ $cuti }}</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a
                href="{{ route('admin.expenses.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Expenses</p>
            </a>
        </li> --}}
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-minus-o"></i>
        <p>
            Hari Libur
            <i class="fas fa-angle-left right"></i>
            {{-- <span class="badge badge-info right">2</span> --}}
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('admin.holidays.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Hari Libur</p>
                <span class="badge badge-info right">{{ $libur }}</span>
            </a>
        </li>
    </ul>
</li>

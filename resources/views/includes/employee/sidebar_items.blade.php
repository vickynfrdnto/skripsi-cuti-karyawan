@php
    use Illuminate\Support\Facades\Auth;
    use App\Leave;
    use App\Attendance;

    $employee = Auth::user()->employee;
    $cuti = Leave::where('status', 'pending')->where('employee_id', $employee->id)->count();
    $absen = Attendance::where('employee_id', $employee->id)->whereNot('registered', null)->count();
@endphp
{{-- <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-check-o"></i>
        <p>
            Absensi
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('employee.attendance.create') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Absensi Hari ini</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('employee.attendance.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Absensi</p>
                <span class="badge badge-info right">{{ $absen }}</span>
            </a>
        </li>
    </ul>
</li> --}}
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-minus-o"></i>
        <p>
            Cuti
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
            href="{{ route('employee.leaves.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Daftar Cuti</p>
                <span class="badge badge-info right">{{ $cuti }}</span>
            </a>
        </li>
    </ul>
</li>
<!-- <li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-calendar-minus-o"></i>
        <p>
            Expenses
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">2</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
            href="{{ route('employee.expenses.create') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Claim Expense</p>
            </a>
        </li>
        <li class="nav-item">
            <a
            href="{{ route('employee.expenses.index') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>List of Expenses</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-address-card"></i>
        <p>
            Self
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">3</span>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a
                href="{{ route('employee.self.salary_slip') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Generate Salary slip</p>
            </a>
        </li>
        <li class="nav-item">
            <a
                href="{{ route('employee.self.holidays') }}"
                class="nav-link"
            >
                <i class="far fa-circle nav-icon"></i>
                <p>Holiday List</p>
            </a>
        </li>
    </ul>
</li> -->

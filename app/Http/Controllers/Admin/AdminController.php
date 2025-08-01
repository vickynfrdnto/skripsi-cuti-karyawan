<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Employee;
use App\User;
use App\Leave;

class AdminController extends Controller
{
    public function index() {
        // Jumlah akun yang memiliki relasi dengan employee (semua karyawan)
        $jml_akun = User::has('employee')->count();

        // Hitung langsung jumlah cuti berdasarkan status
        $jml_pending = Leave::where('status', 'pending')->count();
        $jml_approved = Leave::where('status', 'approved')->count();
        $jml_declined = Leave::where('status', 'declined')->count();

        // Ambil semua data pegawai
        $employees = Employee::with('user')->get();

        // === Tambahan: Data chart jumlah cuti karyawan ===
    $cutiData = Leave::selectRaw('employee_id, SUM(DATEDIFF(end_date, start_date) + 1) as total')
        ->whereIn(DB::raw('LOWER(reason)'), ['cuti', 'sakit'])
        ->whereHas('employee.user', function ($query) {
            $query->whereIn('name', ['Vicky Nanda Ferdianto', 'Septiani Hesty']);
        })
        ->groupBy('employee_id')
        ->with('employee.user')
        ->get()
        ->map(function ($item) {
            return [
                'name' => $item->employee->user->name ?? 'Tidak Diketahui',
                'total' => $item->total
            ];
        });

        $data = [
            'jml_akun' => $jml_akun,
            'jml_pending' => $jml_pending,
            'jml_approved' => $jml_approved,
            'jml_declined' => $jml_declined,
            'employees' => $employees,
            'cutiData' => $cutiData
        ];
        return view('admin.index')->with($data);
    }

    public function reset_password() {
        return view('auth.reset-password');
    }

    public function update_password(Request $request) {
        $user = Auth::user();
        dd($user->password);
        if($user->password == Hash::make($request->old_password)) {
            dd($request->all());
        } else {
            $request->session()->flash('error', 'Password Salah');
            return back();
        }
    }
}

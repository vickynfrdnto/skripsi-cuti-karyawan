<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Leave;
use App\Rules\DateRange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Employee;
use Illuminate\Support\Facades\DB;

class LeaveController extends Controller
{
    public function index() {
        $employee = Auth::user()->employee;

        $data = [
            'employee' => $employee,
            'leaves' => $employee->leave
        ];

        return view('employee.leaves.index')->with($data);
    }

    public function create() {
        $employee = Auth::user()->employee;

        $leaves = Leave::where('employee_id', $employee->id)->get();
        $jml_approved = $leaves->where('status', 'approved')->count();
        $sisa_cuti = $employee->total_cuti - $jml_approved;

        return view('employee.leaves.create')->with([
            'employee' => $employee,
            'sisa_cuti' => $sisa_cuti
        ]);
    }

public function store(Request $request, $employee_id) {
    $employee = Employee::findOrFail($employee_id);

    if ($request->input('multiple-days') == 'yes') {
        $this->validate($request, [
            'reason' => 'required',
            'description' => 'required',
            'date_range' => new DateRange
        ]);

        [$start, $end] = explode(' - ', $request->input('date_range'));
        $start = Carbon::createFromFormat('d-m-Y', trim($start));
        $end = Carbon::createFromFormat('d-m-Y', trim($end));
    } else {
        $this->validate($request, [
            'reason' => 'required',
            'description' => 'required',
            'date' => 'required'
        ]);

        $start = Carbon::createFromFormat('d-m-Y', $request->input('date'));
        $end = $start;
    }

    // Hitung jumlah hari kerja (tidak termasuk akhir pekan)
    $daysRequested = $start->diffInDaysFiltered(function (Carbon $date) {
        return !$date->isWeekend();
    }, $end) + 1;

    $currentYear = Carbon::now()->year;

    // Hitung jumlah cuti disetujui berdasarkan alasan dan tahun
    $usedMarriageLeave = Leave::where('employee_id', $employee->id)
        ->where('reason', 'Menikah')
        ->whereYear('start_date', $currentYear)
        ->where('status', 'approved')
        ->sum(DB::raw("DATEDIFF(COALESCE(end_date, start_date), start_date) + 1"));

    $usedBirthLeave = Leave::where('employee_id', $employee->id)
        ->where('reason', 'Melahirkan')
        ->whereYear('start_date', $currentYear)
        ->where('status', 'approved')
        ->sum(DB::raw("DATEDIFF(COALESCE(end_date, start_date), start_date) + 1"));

    $usedAnnualLeave = Leave::where('employee_id', $employee->id)
        ->where('reason', 'Cuti')
        ->where('status', 'approved')
        ->sum(DB::raw("DATEDIFF(COALESCE(end_date, start_date), start_date) + 1"));

    $usedGriefLeave = Leave::where('employee_id', $employee->id)
        ->where('reason', 'Berduka')
        ->whereYear('start_date', $currentYear)
        ->where('status', 'approved')
        ->sum(DB::raw("DATEDIFF(COALESCE(end_date, start_date), start_date) + 1"));

    // Logika cuti berdasarkan alasan
    switch ($request->input('reason')) {
        case 'Cuti':
            if ($usedAnnualLeave + $daysRequested > $employee->total_cuti) {
                return back()->with('error', 'Sisa cuti tahunan Anda tidak mencukupi.');
            }

            break;

        case 'Melahirkan':
            if ($usedBirthLeave + $daysRequested > 90) {
                return back()->with('error', 'Cuti melahirkan maksimal 90 hari per tahun.');
            }
            break;

        case 'Menikah':
            if ($usedMarriageLeave + $daysRequested > 3) {
                return back()->with('error', 'Cuti menikah maksimal 3 hari per tahun.');
            }
            break;

        case 'Berduka':
            if ($usedGriefLeave + $daysRequested > 3) {
                return back()->with('error', 'Cuti berduka maksimal 3 hari per tahun.');
            }
            break;

        case 'Sakit':
            // tidak dibatasi
            break;
    }

    $employee->save();

    // Simpan data pengajuan cuti
    Leave::create([
        'employee_id' => $employee_id,
        'reason' => $request->input('reason'),
        'description' => $request->input('description'),
        'half_day' => $request->input('half-day'),
        'start_date' => $start,
        'end_date' => ($request->input('multiple-days') == 'yes') ? $end : null,
    ]);

    return redirect()->route('employee.leaves.index')
        ->with('success', 'Pengajuan Cuti Anda berhasil, tunggu persetujuan atasan.');
}


    public function edit($leave_id) {
        $leave = Leave::findOrFail($leave_id);
        Gate::authorize('employee-leaves-access', $leave);

        return view('employee.leaves.edit')->with('leave', $leave);
    }

    public function update(Request $request, $leave_id) {
        $leave = Leave::findOrFail($leave_id);
        Gate::authorize('employee-leaves-access', $leave);

        if ($request->input('multiple-days') == 'yes') {
            $this->validate($request, [
                'reason' => 'required',
                'description' => 'required',
                'date_range' => new DateRange
            ]);

            [$start, $end] = explode(' - ', $request->input('date_range'));
            $start = Carbon::createFromFormat('d-m-Y', trim($start));
            $end = Carbon::createFromFormat('d-m-Y', trim($end));
            $leave->start_date = $start;
            $leave->end_date = $end;
        } else {
            $this->validate($request, [
                'reason' => 'required',
                'description' => 'required',
                'date' => 'required'
            ]);

            $start = Carbon::createFromFormat('d-m-Y', $request->input('date'));
            $leave->start_date = $start;
            $leave->end_date = null;
        }

        $leave->reason = $request->input('reason');
        $leave->description = $request->input('description');
        $leave->half_day = $request->input('half-day');
        $leave->save();

        return redirect()->route('employee.leaves.index')
            ->with('success', 'Update Pengajuan Cuti Anda berhasil.');
    }

    public function destroy($leave_id) {
        $leave = Leave::findOrFail($leave_id);
        Gate::authorize('employee-leaves-access', $leave);
        $leave->delete();

        return redirect()->route('employee.leaves.index')
            ->with('success', 'Pengajuan Cuti Anda berhasil dihapus.');
    }
}

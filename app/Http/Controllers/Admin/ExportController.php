<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Employee;
use Illuminate\Http\Request;
use App\User;
Use App\Leave;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function exportByEmployee(Employee $employee)
    {
        // Pastikan relasi "employee" dan "leaves" sudah dibuat di model User
        $leaves = Leave::where('employee_id', $employee->id)->get();

        $pdf = Pdf::loadView('admin.exports.leave', [
            'employee' => $employee,
            'leaves' => $leaves
        ]);

        return $pdf->download('data-cuti-' . $employee->user->name . '.pdf');
    }

    public function exportByDateRange(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $leaves = Leave::with(['employee.user'])
            ->whereBetween('start_date', [$startDate, $endDate])
            ->orWhereBetween('end_date', [$startDate, $endDate])
            ->orderBy('employee_id')
            ->get();

        $pdf = Pdf::loadView('admin.exports.leave-range', [
            'leaves' => $leaves,
            'start_date' => $startDate->format('d M Y'),
            'end_date' => $endDate->format('d M Y'),
        ]);

        return $pdf->download("laporan-cuti-{$startDate->format('Ymd')}_sd_{$endDate->format('Ymd')}.pdf");
    }
}

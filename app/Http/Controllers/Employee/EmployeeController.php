<?php

namespace App\Http\Controllers\Employee;

use App\Department;
use App\Employee;
use App\User;
use App\Leave;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index() {
        $employee = Auth::user()->employee;

        // Ambil semua cuti milik employee yang login
        $leaves = Leave::where('employee_id', $employee->id)->get();

        // Jumlah cuti approved
        $jml_approved = $leaves->where('status', 'approved')->count();

        // Sisa cuti dihitung
        $sisa_cuti = $employee->total_cuti - $jml_approved;

        // Aktifitas terakhir
        $lastLeaves = Leave::where('employee_id', $employee->id)
                ->orderBy('created_at', 'desc')
                ->take(2)
                ->get();
        Carbon::setLocale('id');

        $data = [
            'employee' => Auth::user()->employee,
            'jml_akun' => User::has('employee')->count(),
            'jml_approved' => $leaves->where('status', 'approved')->count(),
            'jml_declined' => $leaves->where('status', 'declined')->count(),
            'jml_pending' => $leaves->where('status', 'pending')->count(),
            'sisa_cuti' => $sisa_cuti,
            'leaves' => $leaves,
            'aktifitas' => $lastLeaves
        ];
        return view('employee.index')->with($data);
    }

    public function profile() {
        $data = [
            'employee' => Auth::user()->employee
        ];
        return view('employee.profile')->with($data);
    }

    public function profile_edit($employee_id) {
        $data = [
            'employee' => Employee::findOrFail($employee_id),
            'departments' => Department::all(),
            'desgs' => ['Manajer', 'Asistent Manajer', 'Projek Manajer', 'Staff']
        ];
        Gate::authorize('employee-profile-access', intval($employee_id));
        return view('employee.profile-edit')->with($data);
    }

    public function profile_update(Request $request, $employee_id) {
        Gate::authorize('employee-profile-access', intval($employee_id));
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'photo' => 'image|nullable'
        ]);
        $employee = Employee::findOrFail($employee_id);
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->dob = $request->dob;
        $employee->sex = $request->gender;
        $employee->join_date = $request->join_date;
        $employee->desg = $request->desg;
        $employee->department_id = $request->department_id;
        if ($request->hasFile('photo')) {
            // Deleting the old image
            if ($employee->photo != 'user.png') {
                $old_filepath = public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'employee_photos'.DIRECTORY_SEPARATOR. $employee->photo);
                if(file_exists($old_filepath)) {
                    unlink($old_filepath);
                }
            }
            // GET FILENAME
            $filename_ext = $request->file('photo')->getClientOriginalName();
            // GET FILENAME WITHOUT EXTENSION
            $filename = pathinfo($filename_ext, PATHINFO_FILENAME);
            // GET EXTENSION
            $ext = $request->file('photo')->getClientOriginalExtension();
            //FILNAME TO STORE
            $filename_store = $filename.'_'.time().'.'.$ext;
            // UPLOAD IMAGE
            // $path = $request->file('photo')->storeAs('public'.DIRECTORY_SEPARATOR.'employee_photos', $filename_store);
            // add new file name
            $image = $request->file('photo');
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, 300);
            $image_resize->save(public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.$filename_store));
            $employee->photo = $filename_store;
        }
        $employee->save();
        $request->session()->flash('success', 'Profil Anda Berhasil diupdate !');
        return redirect()->route('employee.profile');
    }
}

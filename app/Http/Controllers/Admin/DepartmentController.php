<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function showDepartments(){

        $user_id = Auth::user()->id;

        $department = DB::table('departments')
            ->join('departments_users', 'departments_users.department_id', '=', 'departments.id')
            ->where('departments_users.user_id', $user_id)
            ->get();

        return view('/admin/showDepartments', ['departments' => $department]);
    }

    public function addDepartments(){

        return view('/admin/addDepartments');
    }

    public function saveDepartments(Request $request){

        $user_id = Auth::user()->id;

        $new_department_id = DB::table('departments')->insertGetId(
            [
                'department_code' => $request->depCode,
                'department_name' => $request->depName,
            ]
        );

        DB::table('departments_users')->insert(
            [
                'department_id' => $new_department_id,
                'user_id' => $user_id,
            ]
        );

        return redirect()->action('Admin\DepartmentController@showDepartments');
        //return view('/admin/showDepartments');
    }
}

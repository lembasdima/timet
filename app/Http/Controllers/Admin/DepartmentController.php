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

        if(Auth::user()->hasRole(1) || Auth::user()->hasRole(2)) {
            $user_id = Auth::user()->id;

            $user_parent = DB::table('users')
                ->where('users.id', $user_id)
                ->first();

            if(!$user_parent->user_parent){
                $parent = $user_id;
            }
            else{
                $parent = $user_parent->user_parent;
            }

            $department = DB::table('departments')
                ->join('departments_users', 'departments_users.department_id', '=', 'departments.id')
                ->where('departments_users.user_id', $parent)
                ->get();

            return view('/admin/showDepartments', ['departments' => $department]);
        }
        return view('404');
    }

    public function addDepartments(){

        return view('/admin/addDepartments');
    }

    public function saveDepartments(Request $request){

        if(Auth::user()->hasRole(1)) {

            if(!empty($request->depCode && $request->depName)){
                $new_department_id = DB::table('departments')->insertGetId(
                    [
                        'department_code' => $request->depCode,
                        'department_name' => $request->depName,
                    ]
                );

                DB::table('departments_users')->insert(
                    [
                        'department_id' => $new_department_id,
                        'user_id' => Auth::user()->id,
                    ]
                );

                return redirect()->action('Admin\DepartmentController@showDepartments');
            }
        }
        return view('404');
    }
}

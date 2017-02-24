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

        return view('/admin/showDepartments');
    }

    public function addDepartments(){

        return view('/admin/addDepartments');
    }

    public function saveDepartments(Request $request){
        DB::table('departments')->insert(
            [
                'department_code' => $request->depCode,
                'department_name' => $request->depName,
            ]
        );
        return redirect()->action('Admin\DepartmentController@showDepartments');
        //return view('/admin/showDepartments');
    }
}

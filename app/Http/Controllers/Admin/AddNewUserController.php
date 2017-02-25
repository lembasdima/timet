<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddNewUserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function showUsers(){
        return view('admin\showUsers');
    }

    public function addUser()
    {
        $departments = DB::table('departments')->get();
        $roles = DB::table('roles')->get();
        $status = DB::table('users_status')->get();

        return view('admin/addUser', ['departments' => $departments, 'roles'=>$roles, 'status' => $status]);
    }
/*Переделать на транзакции*/
    public function saveUser(Request $request){

            $user_id = Auth::user()->id;

            $new_user_id = DB::table('users')->insertGetId(
                [
                    'name' => $request->uName,
                    'email' => $request->uEmail,
                    'password' => bcrypt($request->uPassword),
                    'role' => $request->uRole,
                    'status' => $request->uStatus,
                    'user_parent' => $user_id,
                ]
            );

            DB::table('departments_users')->insert(
                [
                    'department_id' => $request->uDepartment,
                    'user_id' => $new_user_id,
                ]
            );

            DB::table('users_roles')->insert(
                [
                    'user_id' => $new_user_id,
                    'role_id' => $request->uRole,
                ]
            );
            return redirect()->action('Admin\AddNewUserController@showUsers');
    }
}

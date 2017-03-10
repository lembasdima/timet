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

            $users = DB::table('users')
                ->where('users.user_parent', $parent)
                ->get();

            return view('/admin/showUsers', ['users' => $users]);
        }
        return view('404');
    }

    public function addUser()
    {
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

            $departments = DB::table('departments')
                ->join('departments_users', 'departments_users.department_id', '=', 'departments.id')
                ->where('departments_users.user_id', $parent)
                ->get();


            $roles = DB::table('roles')->get();
            $status = DB::table('users_status')->get();


            return view('admin/addUser', ['departments' => $departments, 'roles' => $roles, 'status' => $status]);
        }
        return view('404');
    }
/*Переделать на транзакции*/
    public function saveUser(Request $request){

        if(Auth::user()->hasRole(1) || Auth::user()->hasRole(2)) {
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

            DB::table('users_departments')->insert(
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
        return view('404');
    }
}

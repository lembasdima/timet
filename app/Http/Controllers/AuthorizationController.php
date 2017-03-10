<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 10.03.2017
 * Time: 0:06
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;


class AuthorizationController extends Controller
{
    protected $roles = null;

    public function __construct()
    {
        $this->middleware('auth');

        $res = DB::table('roles')->get();

        foreach($res as $val){
            $this->roles[$val->role_name] = $val->id;
        }
    }
}
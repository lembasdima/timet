<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TimeSheetsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTimeSheets()
    {
        $user_id = Auth::user()->id;

        $project_id = DB::table('projects_users')
            ->select('projects_users.project_id')
            ->where('projects_users.user_id', $user_id)
            ->get();


        $projects = DB::table('projects')
            ->join('projects_users', 'projects_users.project_id', '=', 'projects.id')
            ->where('projects_users.user_id', $user_id)
            ->get();
        print_r($projects);

        return view('/time/timesheets', ['projects' => $projects]);
    }

    public function getJsonData(){

        $jsonResponse = array(
            [
                'name'=>'AAaa',
                'state'=>'CA',
            ]
        );

        return response()->json($jsonResponse);
    }
}

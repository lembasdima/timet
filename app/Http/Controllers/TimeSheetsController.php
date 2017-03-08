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
            ->select('projects.id', 'projects.project_name as name')
            ->join('projects_users', 'projects_users.project_id', '=', 'projects.id')
            ->where('projects_users.user_id', $user_id)
            ->get();

        $categories = DB::table('categories')
            ->select('categories.id','categories.name')
            ->join('categories_users', 'categories_users.category_id', '=', 'categories.id' )
            ->where('categories_users.user_id', $user_id)
            ->get();

        return view('/time/timesheets', ['projects' => $projects, 'categories' => $categories]);
    }

    public function getCalendarDate(Request $request){

        $jsonResponse = DB::table('timesheet')
            ->where([
                ['logged_date', '=', $request->date],
                ['user_id', '=', Auth::user()->id]
            ])
            ->get();

        return response()->json($jsonResponse);
    }

    public function getDataToSave(Request $request){

        if($request->id){
            DB::table('timesheet')
                ->where([
                    ['id', '=', $request->id],
                    ['user_id', '=', Auth::user()->id]
            ])
            ->update([
                'project_id' => $request->project_id,
                'category_id' => $request->category_id,
                'description' => $request->description,
                'worked_time' => (int) $request->workedTime
            ]);

        }

        $data = array(
            'result' => true,
        );

        return response()->json($data);
    }

    public function addNewRecord(Request $request){
        $insertResult = DB::table('timesheet')
            ->insertGetId(
                ['user_id' => Auth::user()->id, 'logged_date' => $request->date]
            );

        return response()->json(array('id' => $insertResult));
    }

    public function deleteRecord(Request $request){

        $deletedRow = DB::table('timesheet')
            ->where([
                ['id', '=', $request->id],
                ['user_id', '=', Auth::user()->id]
            ])
            ->delete();

        return response()->json(array('result' => $deletedRow));
    }

    public function getJsonData(Request $request){

        $user_id = Auth::user()->id;



        $dateDay = $request->dateDay;
        $dateMonth = $request->dateMonth;
        $dateYear = $request->dateYear;

        $projects = $request->projects;
        $categories = $request->categories;
        $description = $request->description;
        $workedTime = $request->workedTime;


        var_dump($dateDay);

        $jsonResponse = array(
            [

                'name'=>'AAaa',
                'state'=>'CA',
                'date' => $dateDay,
            ]
        );

        return response()->json($jsonResponse);
    }
}

<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\AuthorizationController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends AuthorizationController
{
    public function __construct(){
        //$this->middleware('auth');
        parent::__construct();
    }


    public function showReport(){

        $users = DB::table('users')
            ->where('users.company_id', Auth::user()->company_id);


        $customers = DB::table('clients')
            ->join('clients_users', 'clients.id', '=', 'clients_users.client_id');

        $customers->where([
            ['clients_users.company_id', Auth::user()->company_id]
        ]);

        if(!Auth::user()->hasRole(1) && !Auth::user()->hasRole(2)){
            $users->where([
                ['users.id', '=', Auth::user()->id]
            ]);
        }

        $projects = DB::table('projects')
            ->where('projects.company_id', Auth::user()->company_id);

        $categories = DB::table('categories')
            ->join('categories_users', 'categories.id', '=', 'categories_users.category_id');

        $categories->where([
            ['categories_users.company_id', Auth::user()->company_id]
        ]);
/*
        if((Auth::user()->hasRole(1) != true) || (Auth::user()->hasRole(2))!=true) {
           var_dump(Auth::user()->role);
            $users->where([
                ['users.id', '=', Auth::user()->id]
            ]);

            $customers->where([
                ['clients_users.company_id', Auth::user()->company_id]
            ]);
        }
*/
        $timesheet = DB::table('timesheet')
            ->where('user_id', Auth::user()->id)
            ->get();


        return view('/reports/reports', [
            'timesheet'=>$timesheet,
            'users' => $users->get(),
            'customers' => $customers->get(),
            'projects' => $projects->get(),
            'categories' => $categories->get(),
        ]);
    }

    public function showReportResult(Request $request){
        //var_dump($request->all());
        $result = DB::table('timesheet')
            ->where('user_id', $request->userName)
            ->where('project_id', $request->projectName)
            ->where('category_id', $request->categoriesName)
            ->whereBetween('logged_date', array($request->dateFrom, $request->dateTo))
            ->get();

        //return Response::json(array('result' => $result));
        return response()->json(['result' => $result]);
    }
}

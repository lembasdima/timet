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


        if(empty($request->dateFrom)){
            $request->dateFrom = date('Y-d-m');
        }

        if(empty($request->dateTo)){
            $request->dateTo = date('Y-d-m');
        }

        $result = DB::table('timesheet')
            ->join('users', 'timesheet.user_id', '=', 'users.id')
            ->join('projects', 'timesheet.project_id', '=', 'projects.id')
            ->join('categories', 'timesheet.category_id', '=', 'categories.id')
            ->join('clients', 'projects.project_customer', '=', 'clients.id');

        $result->where('users.company_id', Auth::user()->company_id);

        if(!empty($request->userName)){
            $result->where('timesheet.user_id', $request->userName);
        }
        if(!empty($request->projectName)) {
            $result->where('timesheet.project_id', $request->projectName);
        }
        if(!empty($request->categoriesName)) {
            $result->where('timesheet.category_id', $request->categoriesName);
        }

        $result->whereBetween('timesheet.logged_date', array($request->dateFrom, $request->dateTo));

        $result->select('timesheet.*', 'clients.name as clientName', 'users.name as userName', 'projects.project_name as projectName', 'categories.name as categoryName');

        $result->orderBy('timesheet.logged_date');

        return response()->json(['result' => $result->get()]);
    }
}

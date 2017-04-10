<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class ProjectController extends AuthorizationController
{
    public function __construct()
	{
		//$this->middleware('auth');
		parent::__construct();
	}

	public function showProjects(){

        if(Auth::user()->hasRole(1) || Auth::user()->hasRole(2)){

            $projects = DB::table('projects')
                ->join('projects_users', 'projects.id', '=', 'projects_users.project_id' )
                ->join('projects_status', 'projects.project_status', '=', 'projects_status.id')
                ->leftJoin('users', 'projects.project_lead', '=', 'users.id')
                ->join('clients as cl', 'projects.project_customer', '=', 'cl.id');

            $projects->where([
                ['projects.company_id', Auth::user()->company_id],
            ]);

            /*На будущее*/
			if(Auth::user()->hasRole(2)){

            }

            $projects->select('*', 'users.name as uName', 'cl.name as clName');




			return view('/projects/projects', ['projects' => $projects->get()->toArray()]);
		}
		return view('404');
	}
	
	public function addProject(){
		if(Auth::user()->hasRole(1)){
			$user_id = Auth::user()->id;

			$typeOfProjects = DB::table('projects_type')->get();

			$customers = DB::table('clients')
				->join('clients_users', 'clients_users.client_id', '=', 'clients.id')
				->where('clients_users.user_id', $user_id)
				->get();

			$typeOfProjects = $typeOfProjects->toArray();

			$projectLead = DB::table('users')
                ->where('users.company_id', Auth::user()->company_id)
                ->get();

			return view('/projects/add', compact('id', 'name'), ['typeOfProjects' => $typeOfProjects, 'customers' => $customers, 'projectLead' => $projectLead]);
		}
		return view('404');
	}
	
	public function saveProject(Request $request){

		if(Auth::user()->hasRole(1)){
			$user_id = Auth::user()->id;

			$ptype = $request->ptype;

			$project_id = DB::table('projects')->insertGetId(
				[
					'project_type' => $ptype,
					'project_name' => $request->pname,
					'project_description' => $request->pdesc,
					'project_customer' => $request->pcustomer,
					'project_budget_time' => $request->pbudgettime,
					'project_budget_money' => $request->pbudgetmoney,
					'project_lead' => (empty($request->plead)) ? NULL : $request->plead, /*Заменить IF*/
					'project_status' => 1,
                    'company_id' => Auth::user()->company_id,
				]
			);

			DB::table('projects_users')->insert(
				[
					'project_id' => $project_id,
					'user_id' => $user_id
				]
			);

			return redirect()->action('ProjectController@showProjects');
		}
		return view('404');
	}
	
}

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

		if(Auth::user()->hasRole($this->roles['admin']) || Auth::user()->hasRole($this->roles['manager'])){

			$user_id = Auth::user()->id;

			$user_parent = DB::table('users')
				->where('users.id', $user_id)
				->first();

			//var_dump($user_parent->user_parent);

			if(!$user_parent->user_parent){
				$parent = $user_id;
			}
			else{
				$parent = $user_parent->user_parent;
			}

			$projects = DB::table('projects')
				->join('projects_users', 'projects.id', '=', 'projects_users.project_id' )
				->where('projects_users.user_id', $parent)
				->get();

			return view('/projects/projects', ['projects' => $projects]);
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

			return view('/projects/add', compact('id', 'name'), ['typeOfProjects' => $typeOfProjects, 'customers' => $customers]);
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
					'project_lead' => $request->plead,
					'project_status' => 1,
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

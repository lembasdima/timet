<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class ProjectController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function showProjects(){

		$user_id = Auth::user()->id;

		$projects = DB::table('projects')
			->join('projects_users', 'projects.id', '=', 'projects_users.project_id' )
			->where('projects_users.user_id', $user_id)
			->get();
		
		return view('/projects/projects', ['projects' => $projects]);
	}
	
	public function addProject(){
		$typeOfProjects = DB::table('projects_type')->get();
		//var_dump($typeOfProjects);
		return view('/projects/add', ['typeOfProjects' => $typeOfProjects]);
	}
	
	public function saveProject(Request $request){

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
		//return view('/projects/projects', ['projectTypes' => $ptype]);
	}
	
}

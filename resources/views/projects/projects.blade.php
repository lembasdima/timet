@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
				<tr>
					<th>ID</th>
					<th>Type</th>
					<th>Name</th>
					<th>Description</th>
					<th>Customer</th>
					<th>Budget In Time</th>
					<th>Budget In Money</th>
					<th>Lead</th>
					<th>Status</th>
				</tr>
				</thead>
				<tbody>
					@foreach($projects as $project)
					<tr>
						<td>{{$project->id}}</td>
						<td>{{$project->project_type}}</td>
						<td>{{$project->project_name}}</td>
						<td>{{$project->project_description}}</td>
						<td>{{$project->project_customer}}</td>
						<td>{{$project->project_budget_time}}</td>
						<td>{{$project->project_budget_money}}</td>
						<td>{{$project->project_lead}}</td>
						<td>{{$project->project_status}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@if(Auth::user()->hasRole(1))
<div class="container">
	<div class="row">
		<div class="col-md-2">
			<a href="{{ url('/projects/add') }}" ><input class="btn btn-success" type="submit" value="Add Project"></a> <br />
		</div>
		<div class="col-md-10">

		</div>
	</div>
</div>
@endif
@endsection
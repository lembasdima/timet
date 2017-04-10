@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Add New Project</div>

				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="post" action="{{ url('/projects/saveProject') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="col-md-4">Project Type</label>
							<select class="form-control" name="ptype">
								@foreach($typeOfProjects as $selectedType){
									<option value="{{$selectedType->id}}">{{$selectedType->type_name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label class="col-md-">Project Name</label>
							<input class="form-control" type="text" name="pname" autofocus>

							<label class="col-md-4">Project Description</label>
							<input class="form-control" type="text" name="pdesc">

							<label class="col-md-4">Customer</label>
							<select class="form-control" name="pcustomer">
								@foreach($customers as $customer)
									<option value="{{$customer->id}}">{{$customer->name}}</option>
								@endforeach
							</select>

							<label class="col-md-4">Budget in time</label>
							<input class="form-control" type="text" name="pbudgettime">

							<label class="col-md-4">Budget in money</label>
							<input class="form-control" type="text" name="pbudgetmoney">

							<label class="col-md-4">Project Lead</label>
							<select name="plead" id="" class="form-control">
								<option value="">Select Project Lead</option>
								@foreach($projectLead as $lead)
									<option value="{{$lead->id}}">{{$lead->name}}</option>
								@endforeach
							</select>

							<input class="btn btn-success" type="submit" value="Add project">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<a href="{{ url('/projects') }}" ><input type="submit" value="Back to projects"></a> <br />
		</div>
	</div>




@endsection
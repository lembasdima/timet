@extends('layouts.app')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Add New Project</div>
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
							<input class="form-control" type="text" name="pcustomer">

							<label class="col-md-4">Budget in time</label>
							<input class="form-control" type="text" name="pbudgettime">

							<label class="col-md-4">Budget in money</label>
							<input class="form-control" type="text" name="pbudgetmoney">

							<label class="col-md-4">Project Lead</label>
							<input class="form-control" type="text" name="plead">

							<input class="btn btn-success" type="submit" value="Add project">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<a href="{{ url('/projects') }}" ><input type="submit" value="Back to projects"></a> <br />



@endsection
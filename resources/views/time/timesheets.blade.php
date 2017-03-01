@extends('layouts.app')
<script>

	var res = '123';

</script>
@section('content')
<div class="container">
	<div class="row">

	</div>
</div>

<div class="container">
	<div class="row">
		<ul class="nav nav-tabs">
			<li class="active">
				<a href="#">Day 1</a>
			</li>
			<li><a href="#">Day 2</a></li>
			<li><a href="#">Day 3</a></li>
			<li><a href="#">Day 4</a></li>
			<li><a href="#">Day 5</a></li>
			<li><a href="#">Day 6</a></li>
		</ul>
	</div>
</div>
<div class="container">
	<div class="row">
		<form action="" method="post">
			<input type="hidden" name="recordRow" value="1">
			<input type="hidden" name="dateDay" value="1">
			<input type="hidden" name="dateMonth" value="1">
			<input type="hidden" name="dateYear" value="1">

		<table class="table">
			<tr>
				<th>Project</th>
				<th>Categories</th>
				<th>Description</th>
				<th>Time</th>
			</tr>

			@for($i = 0; $i < 10; $i++)
			<tr>
				<td>
					<select class="form-control" name="projects">
						<option value=""></option>
						@foreach($projects as $project)
						<option value="{{$project->id}}">{{$project->project_name}}</option>
						@endforeach;
					</select>
				</td>
				<td>
					<select class="form-control" name="">
						<option value="">Cat1</option>
						<option value="">Cat2</option>
						<option value="">Cat3</option>
					</select>
				</td>
				<td><input type="text" value="" name="description"></td>
				<td><input type="text" value="" name="workedTime"></td>
			</tr>
			@endfor
		</table>
		<input class="btn btn-primary" type="submit" value="Save">
		</form>
	</div>
</div>
@endsection
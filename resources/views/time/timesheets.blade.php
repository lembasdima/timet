@extends('layouts.app')

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
					<select class="form-control" name="">
						<option value="">Proj1</option>
						<option value="">Proj2</option>
						<option value="">Proj3</option>
					</select>
				</td>
				<td>
					<select class="form-control" name="">
						<option value="">Cat1</option>
						<option value="">Cat2</option>
						<option value="">Cat3</option>
					</select>
				</td>
				<td>sdfg</td>
				<td>bhdf</td>
			</tr>
			@endfor
		</table>
	</div>
</div>
@endsection
@extends('layouts.app')


@section('content')
	<script>

		var projectName = <?php echo json_encode($projects); ?>

		var categoryName = <?php  echo json_encode($categories); ?>

		function undefinedToString(data){
			if(!data){
				return ""
			}
			else{
				return data;
			}
		}
		function renderSelect(id, data, nameSelector){
			var html = "<select class='form-control' name='" + nameSelector + "'>";

				$.each(data, function(key, value){

					var selected = "";
					if(value.id == id){
						selected = "selected";
					}
					html += "<option " + selected + " value='" + value.id + "'>" + value.name + "</option>"
				});
			return html + "</select>";
		}

		function renderRowProject(data){
			var rowHTML = "<tr data-timesheet-id='" + data.id + "'>";

			rowHTML += wrapTag(renderSelect(data.project_id, projectName, 'projects'),'td')
			rowHTML += wrapTag(renderSelect(data.category_id, categoryName, 'categories'),'td')
			rowHTML += wrapTag('<input class="form-control" type="text" value="' + undefinedToString(data.description) + '" name="description">','td')
			rowHTML += wrapTag('<input class="form-control" type="text" value="' + undefinedToString(data.worked_time) + '" name="workedTime">','td')
			rowHTML += wrapTag("<a href='#' class='deleteTimeRowRecord'>Remove</a>",'td')

			$('#timeSheetTable tbody').append(rowHTML);
		}

		function wrapTag(res, tag){
			return "<" + tag + ">" + res + "</" + tag + ">";
		}

		function getDataToSave($rowToSave){
			var data = {};
			data.id = $rowToSave.data('timesheet-id');
			data.project_id = $rowToSave.find('select[name=projects] option:selected').val();
			data.category_id = $rowToSave.find('select[name=categories] option:selected').val();
			data.description = $rowToSave.find('input[name=description]').val();
			data.workedTime = $rowToSave.find('input[name=workedTime]').val();

			return data;

		}

		function saveData(dataSave){
			$.post('/getDataToSave', dataSave, function(data){
				if(data.result){
					console.log("TRUE");
				}
			});
		}

		function getTimeOnDate(date){
			$('#timeSheetTable tbody').html("");
			$.ajax({
				type: 'POST',
				url: '/getCalendarDate',
				data: {'date': date},
				success: function(data) {

					$.each(data, function(key, value){
						renderRowProject(value);
					});
				},
				error:  function(xhr, str){
					alert('Возникла ошибка: ' + xhr.responseCode);
				}
			});
		}

		function formatTime(){
			//y,m,w,d,h,m,s


		}
	</script>

	<script type="text/javascript" language="javascript">
		function call() {
			var msg   = $('#timesheetForm').serialize();
			$.ajax({
				type: 'POST',
				url: '/getJsonData',
				data: msg,
				success: function(data) {
					$('#results').text("Saved");
					console.log(data);
				},
				error:  function(xhr, str){
					alert('Возникла ошибка: ' + xhr.responseCode);
				}
			});

		}
	</script>

	<script type="text/javascript" language="javascript">
		$(document).ready(function(){
			var currentData = moment().format("YYYY-MM-DD");
			getTimeOnDate(currentData);

			$('#paginator').datepaginator({
				onSelectedDateChanged: function(event, date){
					currentData = date._i;
					getTimeOnDate(currentData);
				}
			});

			$(document).on('blur', "input", function(){
				saveData(getDataToSave($(this).parents('tr')));
			});

			$(document).on('change', "select", function(){
				saveData(getDataToSave($(this).parents('tr')));
			});

			$('#addNewRecord').click(function(){
				$.post('/addNewRecord', {date:currentData}, function(data){
					renderRowProject(data);
				});
			});

			$(document).on('click', ".deleteTimeRowRecord", function(){
				var $root = $(this).parents('tr');

				var id = $root.data('timesheet-id');


				$.post('/deleteRecord', {id:id}, function(data){
					/*нужны проверки*/
					if(data.result){
						$root.remove();
					}
				});

				return false;
			});

		});
	</script>

<div class="container">
	<div class="row">

	</div>
</div>

<div class="container">
	<div class="row">
		<h2>Default</h2>
		<div id="paginator"></div>
		<br/>
	</div>
</div>

<div class="container">
	<div class="row">
		<form action="javascript:void(null);" onsubmit="call()" method="post" id="timesheetForm">
			{{ csrf_field() }}
			<input type="hidden" name="recordRow" value="1">
			<input type="hidden" name="dateDay" value="1">
			<input type="hidden" name="dateMonth" value="1">
			<input type="hidden" name="dateYear" value="1">

		<table class="table" id="timeSheetTable">
			<thead>
			<tr>
				<th>Project</th>
				<th>Categories</th>
				<th>Description</th>
				<th>Time</th>
				<th></th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
		<button type="button" id="addNewRecord">Add Record</button>
		</form>
	</div>
</div>
<div id="results"></div>
@endsection

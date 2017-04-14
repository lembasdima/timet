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
			rowHTML += wrapTag('<input class="form-control renderDataTime" type="text" value="' + undefinedToString(data.worked_time) + '" name="workedTime">','td')
			rowHTML += wrapTag("<a href='#' class='deleteTimeRowRecord'>Remove</a>",'td')

			$('#timeSheetTable tbody').append(rowHTML);
            formatTimeAfterReload();
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

            data.workedTime = prettyTime(data.workedTime, 'hour', true);

			return data;

		}

        function prettyTime(time, timeNotation, showZero) {
            time = time.toString().replace(/,/g, '.').replace(/;/g, ':');
            if (time != '') {
                if (timeNotation == 'decimal') {
                    if (time == "0") {
                        time = "0:00";
                    }
                    if (time.indexOf('.') == -1) {
                        // van 'hour' naar 'decimal'
                        var colon = time.indexOf(':');
                        if (colon == 0) {
                            time = "0" + time;
                        }
                        var timeArray = time.split(':');
                        var hours = parseInt(timeArray[0], 10);
                        var minutes = (timeArray[1] ? parseInt(timeArray[1], 10) : 0);
                        if (isNaN(hours) || isNaN(minutes)) {
                            return '';
                        } else {
                            time =  hours + (minutes/60);
                        }
                    }
                    time = Math.round(time*100)/100;
                    if (time == parseInt(time)) {
                        time = time+".00";
                    }
                    var timeArray = time.toString().split('.');
                    if (timeArray[1].length == 1) {
                        time = time+"0";
                    }
                    /*
                    if (currentLanguage == 'nl') {
                        time = time.toString().replace('.', ',');
                    }
                    */
                } else if (timeNotation == 'hour') {
                    if (time.indexOf(':') == -1) {
                        // van 'decimal' naar 'hour'
                        var point = time.indexOf('.');
                        if (point == 0) {
                            time = "0" + time;
                        }
                        var timeArray = time.split('.');
                        var hours = parseInt(timeArray[0], 10);
                        var minutes = Math.round((time - hours)*100);
                        minutes = Math.round(minutes * 0.6);
                        if (isNaN(hours) || isNaN(minutes)) {
                            return '';
                        } else {
                            if (minutes == 60) {
                                hours++;
                                minutes = 0;
                            }
                            if (minutes.toString().length == 0) {
                                minutes = '00';
                            } else if (minutes.toString().length == 1) {
                                minutes = '0' + minutes;
                            }
                            time = hours + ":" + minutes;
                        }
                    } else {
                        var timeArray = time.split(':');
                        var hours = parseInt(timeArray[0], 10);
                        if (isNaN(hours)) {
                            hours = 0;
                        }
                        var minutes = (timeArray[1] ? parseInt(timeArray[1], 10) : 0);
                        if (minutes > 60) {
                            var moreHours = parseInt(minutes/60);
                            hours += moreHours;
                            minutes = minutes - (moreHours*60);
                        }
                        if (minutes == 60) {
                            hours++;
                            minutes = 0;
                        }
                        if (minutes.toString().length == 0) {
                            minutes = '00';
                        } else if (minutes.toString().length == 1) {
                            minutes = '0' + minutes;
                        }
                        time = hours + ":" + minutes;
                    }
                }
            }
            if ((time == '0.00' || time == '0:00') && !showZero) {
                time = '';
            }

            console.log(time + " tt");

            return time;
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

		function formatTimeAfterReload(){
            $('input[name=workedTime]').each(function (key, val) {
                $(this).val(prettyTime($(this).val(), 'hour', true));
            });
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
				var resData = getDataToSave($(this).parents('tr'));
			    saveData(resData);
			    if($(this).hasClass('renderDataTime')){
                    $(this).val(resData.workedTime);
				}

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

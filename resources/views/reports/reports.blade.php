<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 15.03.2017
 * Time: 13:08
 */
?>

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <form action="" method="post" id="selectReportForm">
                <div class="form-group">
                    <label>User name</label>

                    <select name="userName">
                        <option value="">All</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label>Customer</label>

                    <select name="customerName">
                        <option value="">All</option>
                        @foreach($customers as $customer)
                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Project</label>

                    <select name="projectName">
                        <option value="">All</option>
                        @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->project_name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label>Categories</label>

                    <select name="categoriesName">
                        <option value="">All</option>
                        @foreach($categories as $category)
                            <option value="{{$category->category_id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="container">
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <label>From</label>
                                <div class='input-group date datetimepickerFrom'>
                                    <input type='text' class="form-control" name="dateFrom"/>
                                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">


                            $(function () {

                                var myDate = new Date();

                                $('.datetimepickerFrom').datetimepicker({
                                    format: 'YYYY-MM-DD',
                                    defaultDate: new Date(myDate.setDate(myDate.getDate() - 7))
                                });

                                $('.datetimepickerTo').datetimepicker({
                                    format: 'YYYY-MM-DD',
                                    defaultDate: new Date()
                                });

                                $('#showReportsResult').click(function () {
                                    var selectReportForm = $('#selectReportForm').serialize();
                                    $.post('/showReportResult', selectReportForm, function (data) {

                                        var html = '';
                                        var totalTimeCount = 0;
                                        $.each(data.result,function(key, value){

                                            html += "<tr><td>" + value.logged_date + "</td>" +
                                                    "<td>" + value.userName + "</td>" +
                                                    "<td>" + value.projectName + "</td>" +
                                                    "<td>" + value.categoryName + "</td>" +
                                                    "<td>" + value.description + "</td>" +
                                                    "<td>" + value.worked_time + "</td>" +
                                                "</tr>"
                                            totalTimeCount += value.worked_time;
                                        });

                                        $('#reportResultTable tbody').html(html);
                                        $('#reportResultTable tfoot tr td span').text(totalTimeCount);
                                    });
                                    //console.log(selectReportForm);
                                });
                            });
                        </script>


                        <div class='col-sm-6'>
                            <div class="form-group">
                                <label>To</label>
                                <div class='input-group date datetimepickerTo'>
                                    <input type='text' class="form-control" name="dateTo"/>
                                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="text-right">
                            <button class="btn btn-success" id="showReportsResult" type="button">Show</button>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered" id="reportResultTable">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Project</th>
                        <th>Categories</th>
                        <th>Description</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-right">
                                total <span></span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
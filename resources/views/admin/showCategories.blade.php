<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 07.03.2017
 * Time: 0:49
 */
?>
@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->code}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ url('/admin/addCategories') }}" ><input class="btn btn-success" type="submit" value="Add Category"></a> <br />
            </div>
            <div class="col-md-10">

            </div>
        </div>
    </div>
@endsection


<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 07.03.2017
 * Time: 0:43
 */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{url('/admin/saveCategories')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Category Name
                        <input name="categoryName" type="text" value="">
                    </label>
                </div>
                <div class="form-group">
                    <label>Category Code
                        <input name="categoryCode" type="text" value="">
                    </label>
                </div>

                <div class="form-group">
                    <label>Category Description
                        <input name="categoryDescr" type="text" value="">
                    </label>
                </div>

                <input class="btn btn-primary" type="submit" value="Add">
            </form>
        </div>
    </div>
@endsection

<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 24.02.2017
 * Time: 21:12
 */
?>

@extends('layouts.app')

@section('content')
   <h1>Add client</h1>

   <div class="container">
       <div class="row">
           <form action="{{'/admin/saveClient'}}" method="post">
               {{ csrf_field() }}
               <div class="form-group">
                    <label>Client name</label>
                    <input name="clientName" type="text" value="">
               </div>

               <div class="form-group">
                   <label>Client code</label>
                   <input name="clientCode" type="text" value="">
               </div>

               <div class="form-group">
                   <label>Status</label>
                   <select name="clientStatus">
                       <option value="1">Not approve</option>
                       <option value="2">Pending</option>
                       <option value="5">Approve</option>
                   </select>
               </div>

               <input class="btn btn-primary" type="submit" value="Add">
           </form>
       </div>
   </div>
@endsection

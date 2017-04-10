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
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{$department->id}}</td>
                                <td>{{$department->department_code}}</td>
                                <td>{{$department->department_name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if(Auth::user()->hasRole(1))
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ url('/admin/addDepartments') }}" ><input class="btn btn-success" type="submit" value="Add Department"></a> <br />
            </div>
            <div class="col-md-10">

            </div>
        </div>
    </div>
    @endif
@endsection
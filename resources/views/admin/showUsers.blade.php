@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role_name}}</td>
                            <td>{{$user->status_name}}</td>
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
                <a href="{{ url('/admin/addUser') }}" ><input class="btn btn-success" type="submit" value="Add User"></a> <br />
            </div>
            <div class="col-md-10">

            </div>
        </div>
    </div>
@endsection
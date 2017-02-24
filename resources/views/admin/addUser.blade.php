@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{ url('/admin/saveUser') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Name</label>
                    <input name="uName" type="text" value="">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="uEmail" type="email" value="">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="uPassword" type="password" value="">
                </div>
                <div class="form-group">
                    <label>Department</label>
                    <select name="uDepartment">
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="uRole">
                        @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->role_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="uStatus">
                        @foreach($status as $user_status)
                            <option value="{{$user_status->id}}">{{$user_status->status_name}}</option>
                        @endforeach
                    </select>
                </div>

                <input class="btn btn-primary" type="submit" value="Add">
            </form>
        </div>
    </div>
@endsection
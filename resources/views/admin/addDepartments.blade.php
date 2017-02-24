@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <form action="{{url('/admin/saveDepartments')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Department Name
                        <input name="depName" type="text" value="">
                    </label>
                </div>
                <div class="form-group">
                    <label>Department Code
                        <input name="depCode" type="text" value="">
                    </label>
                </div>

                <input class="btn btn-primary" type="submit" value="Add">
            </form>
        </div>
    </div>
@endsection
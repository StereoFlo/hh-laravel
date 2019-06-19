@extends('layouts.app')
@section('content')
    <form method="post" action="{{ route('admin_user_from_process') }}">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" name="login" id="login"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password"/>
        </div>
        <button type="submit">Submit</button>
        {{ csrf_field() }}
    </form>
@endsection

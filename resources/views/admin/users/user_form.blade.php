@extends('layouts.app')
@section('content')
    <form method="post" action="{{ route('admin_user_from_process') }}">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" name="login" id="login" value="{{ (isset($user) && $user->login) ? $user->login : '' }}"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password"/>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role">
                <option value="user" {{ (isset($user) && $user->role == 'user') ? 'selected' : '' }}>User</option>
                <option value="admin" {{ (isset($user) && $user->role == 'admin') ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button type="submit">Submit</button>
        @if(isset($user) && $user->id)
            <input type="hidden" name="id" value="{{ $user->id }}">
        @endif
        {{ csrf_field() }}
    </form>
@endsection

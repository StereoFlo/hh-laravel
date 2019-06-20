@extends('layouts.app')
@section('content')
    <table class="table">
        <tbody>
        @foreach($users as $user)
        <tr>
            <th>{{ $user['id']  }}</th>
            <th>{{ $user['login']  }}</th>
            <th>{{ $user['role']  }}</th>
            <th>{{ $user['token']  }}</th>
            <th>{{ $user['created_at']  }}</th>
            <th>{{ $user['updated_at']  }}</th>
            <th><a href="{{ route('admin_user_from_update', ['id' => $user['id']]) }}">Update</a> <a href="{{ route('admin_user_remove', ['id' => $user['id']]) }}">Remove</a> </th>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection

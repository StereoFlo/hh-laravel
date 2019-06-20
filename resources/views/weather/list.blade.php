@extends('layouts.app')
@section('content')
    <table class="table">
        <tbody>
        @foreach($cities as $city)
            <tr>
                <th>{{ $city['city_id']  }}</th>
                <th>{{ $city['city_name']  }}</th>
                <th>{{ $city['city_user_query']  }}</th>
                <th>
                    <a href="{{ route('admin_weather_show', ['id' => $city['city_id']]) }}">View</a>
                    <a href="{{ route('admin_weather_delete_city', ['id' => $city['city_id']]) }}">Remove</a> </th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $cities->links() }}
@endsection

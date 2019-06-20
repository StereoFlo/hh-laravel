@extends('layouts.app')
@section('content')
    <form method="post" action="{{ route('admin_weather_add_city') }}">
        <div class="form-group">
            <label for="name">Enter a city name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ (isset($city) && $city->city_user_query) ? $user->city_user_query : '' }}"/>
        </div>
        <button type="submit">Submit</button>
        @if(isset($city) && $city->id)
            <input type="hidden" name="id" value="{{ $city->id }}">
        @endif
        {{ csrf_field() }}
    </form>
@endsection

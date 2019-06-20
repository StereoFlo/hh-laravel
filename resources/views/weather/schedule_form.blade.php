@extends('layouts.app')
@section('content')
    <form method="post" action="{{ route('admin_weather_schedule_form') }}">
        <div class="form-group">
            <label for="date">Enter a time</label>
            <input type="time" class="form-control" name="date" id="date"/>
        </div>
        <button type="submit">Submit</button>
        {{ csrf_field() }}
    </form>
@endsection

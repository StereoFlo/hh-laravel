@extends('layouts.app')
@section('content')
    @if(empty($schedules->count()))
        <p>No schedules added yet. But you can do that <a href="{{ route('admin_weather_schedule_form') }}">here</a> </p>
    @else
    <table class="table">
        <tbody>
        @foreach($schedules as $schedule)
            <tr>
                <th>{{ $schedule['run_at'] }}</th>
                <th>
                    <a href="{{ route('admin_weather_schedule_delete', ['id' => $schedule['id']]) }}">Remove</a>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $schedules->links() }}
    @endif
@endsection

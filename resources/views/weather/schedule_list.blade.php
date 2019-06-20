@extends('layouts.app')
@section('content')
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
@endsection

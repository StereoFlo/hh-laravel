@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ !isset($city[0]['city_name']) ?: $city[0]['city_name'] }}
        </div>
        <div class="card-body">
            @foreach($city as $cityData)
            <h5 class="card-title">{{ $cityData['created_at'] }}</h5>
            <p class="card-text">
                Temp: {{ $cityData['today_temp'] }},
                Max temp: {{ $cityData['today_max_temp'] }},
                Min temp: {{ $cityData['today_min_temp'] }}
            </p>
            @endforeach
        </div>
    </div>
@endsection

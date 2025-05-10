@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Request Booking for {{ $car->brand }} {{ $car->model }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $car->brand }} {{ $car->model }} ({{ $car->year }})</h5>
            <p class="card-text">Plate Number: {{ $car->plate_number }}</p>
            <p class="card-text">Transmission: {{ ucfirst($car->transmission) }}</p>
            <p class="card-text">Type: {{ $car->type }}</p>
            <p class="card-text">Price per day: ${{ number_format($car->price, 2) }}</p>
            <p class="card-text">Branch: {{ $car->branch->name }}</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('bookings.store') }}">
        @csrf
        <input type="hidden" name="car_id" value="{{ $car->id }}">

        <div class="mb-3">
            <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">{{ __('End Date') }}</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Request Booking') }}</button>
        <a href="{{ route('cars.index') }}" class="btn btn-secondary ms-2">{{ __('Cancel') }}</a>
    </form>
</div>
@endsection
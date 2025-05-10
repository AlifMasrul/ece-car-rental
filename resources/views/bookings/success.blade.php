@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Booking Successful!</h1>
    <p>Your booking has been created successfully.</p>
    <a href="{{ route('cars.index') }}" class="btn btn-primary">Back to Car List</a>
</div>
@endsection
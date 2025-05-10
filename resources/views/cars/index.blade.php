@extends('layouts.app')

@section('content')
<div class="container">
    @auth
    <div class="mb-3">
        <a href="{{ route('profile.history') }}" class="btn btn-outline-info">My Booking History</a>
        <a href="{{ route('profile.pending-cancellations') }}" class="btn btn-outline-warning ms-2">Cancellation Pending</a>
    </div>
    @endauth

    <h1>Car List</h1>

    <div class="mb-3">
        <form action="{{ route('cars.index') }}" method="GET">
            <div class="row">
                <div class="col-md-3">
                    <label for="branch_id" class="form-label">Branch:</label>
                    <select name="branch_id" id="branch_id" class="form-select">
                        <option value="">All Branches</option>
                        @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="type" class="form-label">Type:</label>
                    <select name="type" id="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="Sedan" {{ request('type') == 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="SUV" {{ request('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="MPV" {{ request('type') == 'MPV' ? 'selected' : '' }}>MPV</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="transmission" class="form-label">Transmission:</label>
                    <select name="transmission" id="transmission" class="form-select">
                        <option value="">All</option>
                        <option value="Auto" {{ request('transmission') == 'Auto' ? 'selected' : '' }}>Auto</option>
                        <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="brand" class="form-label">Brand:</label>
                    <input type="text" name="brand" id="brand" class="form-control" value="{{ request('brand') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Filter</button>
            <a href="{{ route('cars.index') }}" class="btn btn-secondary mt-3 ms-2">Reset</a>
        </form>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Plate Number</th>
                <th>Type</th>
                <th>Transmission</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
            <tr>
                <td>{{ $car->plate_number }}</td>
                <td>{{ $car->type }}</td>
                <td>{{ $car->transmission }}</td>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->branch->name }}</td>
                <td>
                    @auth
                    <a href="{{ route('bookings.create', ['car_id' => $car->id]) }}" class="btn btn-sm btn-primary">Request Booking</a>
                    @else
                    <p class="mb-0">Log in to book</p>
                    @endauth
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection